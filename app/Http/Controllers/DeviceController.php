<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContractRequest;
use App\Http\Requests\DeviceRequest;
use App\Http\Requests\EuropeanNormRequest;
use App\Http\Requests\GuaranteeRequest;
use App\Http\Requests\InstallationRequest;
use App\Models\Contract;
use App\Models\ContractCustomerDevice;
use App\Models\Customer;
use App\Models\Device;
use App\Models\DeviceSupply;
use App\Models\EuropeanNorm;
use App\Models\Guarantee;
use App\Models\Installation;
use App\Models\Intervention;
use App\Models\InterventionUser;
use App\Models\RenewalContract;
use App\Models\RenewalGuarantee;
use App\Models\Sale;
use App\Models\Type;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Boolean;

class DeviceController extends Controller
{
    public function index()
    {
        return view('devices/devices');
    }

    public function create()
    {
        $users = User::withTrashed();
        $types = Type::all();
        $customers = Customer::all();
        return view('devices/devices-create')->with(compact('users', 'types', 'customers'));
    }

    public function store(Request $request)
    {
        if ($request->input('available') == 0) {
            if ($request->hasFile('installationPicture')) {
                $installationPicture = 'Installation_' . time() . '_' . $request->serialNumber . '_' . $request->productReference . '.' . $request->installationPicture->extension();
                $request->installationPicture->move(('storage'), $installationPicture);
                $installation = Installation::create([
                    'picture_path' => $installationPicture,
                    'date' => Carbon::parse($request->input('installationDate'))->format('Y-m-d'),
                    'summary' => $request->input('installationSummary'),
                    'user_id' => $request->input('technician'),
                ]);
            }
            $contract = Contract::create([
                'initialDuration' => $request->input('contract'),
                'customer_id' => $request->input('customer'),
            ]);

            $guarantee = Guarantee::create([
                'initialDuration' => $request->input('guarantee'),
            ]);
            if ($request->input('europeanNorm') == 1) {
                if ($request->hasFile('europeanNormPicture')) {
                    $europeanNormPicture = 'European_norm_' . time() . '_' . $request->serialNumber . '_' . $request->productReference . '.' . $request->europeanNormPicture->extension();
                    $request->europeanNormPicture->move(public_path('storage'), $europeanNormPicture);
                    $europeanNorm = EuropeanNorm::create([
                        'picture_path' => $europeanNormPicture,
                    ]);
                    Device::create([
                        'serialNumber' => strtoupper($request->input('serialNumber')),
                        'productReference' => strtoupper($request->input('productReference')),
                        'saleDate' => Carbon::parse($request->input('saleDate'))->format('Y-m-d'),
                        'installation_id' => $installation->id,
                        'type_id' => $request->input('type'),
                        'customer_id' => $request->input('customer'),
                        'europeanNorm_id' => $europeanNorm->id,
                        'contract_id' => $contract->id,
                        'guarantee_id' => $guarantee->id,
                    ]);
                }
            } else {
                Device::create([
                    'serialNumber' => strtoupper($request->input('serialNumber')),
                    'productReference' => strtoupper($request->input('productReference')),
                    'saleDate' => Carbon::parse($request->input('saleDate'))->format('Y-m-d'),
                    'installation_id' => $installation->id,
                    'type_id' => $request->input('type'),
                    'customer_id' => $request->input('customer'),
                    'europeanNorm_id' => null,
                    'contract_id' => $contract->id,
                    'guarantee_id' => $guarantee->id,
                ]);
            }
        } else {
            if ($request->input('europeanNorm') == 1) {
                if ($request->hasFile('europeanNormPicture')) {
                    $europeanNormPicture = time() . '_' . $request->serialNumber . '_' . $request->productReference . '.' . $request->europeanNormPicture->extension();
                    $request->europeanNormPicture->move(public_path('storage'), $europeanNormPicture);
                    $europeanNorm = EuropeanNorm::create([
                        'picture_path' => $europeanNormPicture,
                    ]);
                    Device::create([
                        'serialNumber' => strtoupper($request->input('serialNumber')),
                        'productReference' => strtoupper($request->input('productReference')),
                        'saleDate' => null,
                        'installation_id' => null,
                        'type_id' => $request->input('type'),
                        'customer_id' => null,
                        'europeanNorm_id' => $europeanNorm->id,
                        'contract_id' => null,
                        'guarantee_id' => null,
                    ]);
                }
            } else {
                Device::create([
                    'serialNumber' => strtoupper($request->input('serialNumber')),
                    'productReference' => strtoupper($request->input('productReference')),
                    'saleDate' => null,
                    'installation_id' => null,
                    'type_id' => $request->input('type'),
                    'customer_id' => null,
                    'europeanNorm_id' => null,
                    'contract_id' => null,
                    'guarantee_id' => null,
                ]);
            }
        }
        return redirect()->route('devices');
    }

    public function edit($id)
    {
        $device = Device::find($id);
        $users = User::withTrashed()();
        $types = Type::all();
        $customers = Customer::all();
        return view('devices/devices-update')->with(compact('users', 'types', 'customers', 'device'));
    }

    public function update(Request $request, $id)
    {
        $device = Device::find($id);
        $device->serialNumber = strtoupper($request->input('serialNumber'));
        $device->productReference = strtoupper($request->input('productReference'));
        $device->type_id = $request->input('type');

        if ($request->input('available') == 0) {
            if ($device->installation_id != null) {
                if ($request->input('europeanNorm') == 1) {
                    if ($device->europeanNorm_id == null) {
                        if ($request->hasFile('europeanNormPicture')) {
                            $europeanNormPicture = 'European_norm_' . time() . '_' . strtoupper($device->serialNumber) . '_' . strtoupper($device->productReference) . '.' . $request->europeanNormPicture->extension();
                            $request->europeanNormPicture->move(public_path('storage'), $europeanNormPicture);
                            $europeanNorm = EuropeanNorm::create([
                                'picture_path' => $europeanNormPicture,
                            ]);
                            $device->europeanNorm_id = $europeanNorm->id;
                            $device->save();
                        }
                    }
                } else {
                    $device->europeanNorm_id = null;
                    $device->save();
                }
                $device->saleDate = Carbon::parse($request->input('saleDate'))->format('Y-m-d');
                $device->customer_id = $request->input('customer');
                $contract = Contract::find($device->contract_id);
                $contract->initialDuration = $request->input('contract');
                $contract->customer_id = $request->input('customer');
                $guarantee = Guarantee::find($device->guarantee_id);
                $guarantee->initialDuration = $request->input('guarantee');
                $installation = Installation::find($device->installation_id);
                $installation->date = Carbon::parse($request->input('installationDate'))->format('Y-m-d');
                $installation->summary = $request->input('installationSummary');
                $installation->user_id = $request->input('technician');
                $device->save();
                $guarantee->save();
                $contract->save();
                $installation->save();
            } else {
                if ($request->input('europeanNorm') == 1) {
                    if ($device->europeanNorm_id == null) {
                        if ($request->hasFile('europeanNormPicture')) {
                            $europeanNormPicture = 'European_norm_' . time() . '_' . strtoupper($device->serialNumber) . '_' . strtoupper($device->productReference) . '.' . $request->europeanNormPicture->extension();
                            $request->europeanNormPicture->move(public_path('storage'), $europeanNormPicture);
                            $europeanNorm = EuropeanNorm::create([
                                'picture_path' => $europeanNormPicture,
                            ]);
                            $device->europeanNorm_id = $europeanNorm->id;
                            $device->save();
                        }
                    }
                }
                if ($request->hasFile('installationPicture')) {
                    $installationPicture = 'Installation_' . time() . '_' . strtoupper($device->serialNumber) . '_' . strtoupper($device->productReference) . '.' . $request->installationPicture->extension();
                    $request->installationPicture->move(('storage'), $installationPicture);
                    $installation = Installation::create([
                        'picture_path' => $installationPicture,
                        'date' => Carbon::parse($request->input('installationDate'))->format('Y-m-d'),
                        'summary' => $request->input('installationSummary'),
                        'user_id' => $request->input('technician'),
                    ]);
                }
                $contract = Contract::create([
                    'initialDuration' => $request->input('contract'),
                    'customer_id' => $request->input('customer')
                ]);
                $contract->save();

                $guarantee = Guarantee::create([
                    'initialDuration' => $request->input('guarantee')
                ]);
                $guarantee->save();

                $device->saleDate = Carbon::parse($request->input('saleDate'))->format('Y-m-d');
                $device->customer_id = $request->input('customer');
                $device->contract_id = $contract->id;
                $device->guarantee_id = $guarantee->id;
                $device->installation_id = $installation->id;
                $device->save();
            }
        } else {
            if ($request->input('europeanNorm') == 1) {
                if ($device->europeanNorm_id == null) {
                    if ($request->hasFile('europeanNormPicture')) {
                        $europeanNormPicture = 'European_norm_' . time() . '_' . strtoupper($device->serialNumber) . '_' . strtoupper($device->productReference) . '.' . $request->europeanNormPicture->extension();
                        $request->europeanNormPicture->move(public_path('storage'), $europeanNormPicture);
                        $europeanNorm = EuropeanNorm::create([
                            'picture_path' => $europeanNormPicture,
                        ]);
                        $device->europeanNorm_id = $europeanNorm->id;
                        $device->save();
                    }
                }
            } else {
                $device->europeanNorm_id = null;
                $device->save();
            }
            $device->saleDate = null;
            $device->installation_id = null;
            $device->customer_id = null;
            $device->contract_id = null;
            $device->guarantee_id = null;
            $device->save();
        }
        return redirect('devices');
    }

    public function destroy($id)
    {
        $interventions = Intervention::all()->where('device_id', 'LIKE', $id);
        $sales = Sale::all()->where('device_id', 'LIKE', $id);
        $devicesSupplies = DeviceSupply::all()->where('device_id', 'LIKE', $id);

        foreach($interventions as $intervention) {
            $interventionsUsers = InterventionUser::all()->where('maintenance_id', $intervention->id);
            foreach ($interventionsUsers as $interventionUser) {
                $interventionUser->delete();
            }
            $intervention->delete();
        }

        foreach($sales as $sale)
        {
            $sale->delete();
        }

        foreach($devicesSupplies as $deviceSupply)
        {
            $deviceSupply->delete();
        }

        Device::find($id)->delete();
        return redirect('devices');
    }

    public function contract($id)
    {
        $device = Device::find($id);
        $renewalsContract = RenewalContract::all();
        return view('devices/devices-contract')->with(compact('device', 'renewalsContract'));
    }

    public function guarantee($id)
    {
        $device = Device::find($id);
        $renewalsGuarantee = RenewalGuarantee::all();
        return view('devices/devices-guarantee')->with(compact('device', 'renewalsGuarantee'));
    }
}
