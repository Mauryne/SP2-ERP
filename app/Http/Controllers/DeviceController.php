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
use App\Models\EuropeanNorm;
use App\Models\Guarantee;
use App\Models\Installation;
use App\Models\RenewalContract;
use App\Models\RenewalGuarantee;
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
        $users = User::all();
        $types = Type::all();
        $customers = Customer::all();
        return view('devices/devices-create')->with(compact('users', 'types', 'customers'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('installationPicture')) {
            //$installationRequest->validated();
            $installationPicture = 'Installation_'. time() . '_' . $request->serialNumber . '_' . $request->productReference . '.' . $request->installationPicture->extension();
            $request->installationPicture->move(('storage'), $installationPicture);
            $installation = Installation::create([
                'picture_path' => $installationPicture,
                'date' => Carbon::parse($request->input('installationDate'))->format('Y-m-d'),
                'summary' => $request->input('installationSummary'),
                'user_id' => $request->input('technician'),
            ]);

            //$contractRequest->validated();
            $contract = Contract::create([
                'initialDuration' => $request->input('contract'),
                'customer_id' => $request->input('customer'),
            ]);

            //$guaranteeRequest->validated();
            $guarantee = Guarantee::create([
                'initialDuration' => $request->input('guarantee'),
            ]);

            if ($request->hasFile('europeanNormPicture')) {
                //$europeanNormRequest->validated();
                $europeanNormPicture = 'European_norm_'. time() . '_' . $request->serialNumber . '_' . $request->productReference . '.' . $request->europeanNormPicture->extension();
                $request->europeanNormPicture->move(public_path('storage'), $europeanNormPicture);
                $europeanNorm = EuropeanNorm::create([
                    'picture_path' => $europeanNormPicture,
                ]);
                //$deviceRequest->validated();
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
            } else {
                //$deviceRequest->validated();
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
            if ($request->hasFile('europeanNormPicture')) {
                //$europeanNormRequest->validated();
                $europeanNormPicture = time() . '_' . $request->serialNumber . '_' . $request->productReference . '.' . $request->europeanNormPicture->extension();
                $request->europeanNormPicture->move(public_path('storage'), $europeanNormPicture);
                $europeanNorm = EuropeanNorm::create([
                    'picture_path' => $europeanNormPicture,
                ]);
                //$deviceRequest->validated();
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
            } else {
                //$deviceRequest->validated();
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
        // Pb update : renvoie mauvaise vue si on écrit devices-update
        $device = Device::find($id);
        $users = User::all();
        $types = Type::all();
        $customers = Customer::all();
        return view('devices/devices-updates')->with(compact('users', 'types', 'customers', 'device'));
    }

    public function update(Request $request, $id)
    {
        $device = Device::find($id);
        $device->serialNumber = $request->input('serialNumber');
        $device->productReference = $request->input('productReference');
        // en fonction des choix
        $device->saleDate = Carbon::parse($request->input(''))->format('Y-m-d');
        $device->installation_id = $request->input('');
        $device->europeanNorm_id = $request->input('');
        $device->contract_id = $request->input('');
        $device->guarantee_id = $request->input('');
        $device->save();

        InterventionUser::where('maintenance_id', $id)->delete();

        foreach ($request->user as $user) {
            InterventionUser::create(
                ['user_id' => $user,
                    'maintenance_id' => $id,
                ]);
        }

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


    // self::saveFile($request->input('europeanNormPicture'), 'storage');
//        $europeanNorm = EuropeanNorm::create([
//            'picture_path' => $europeanNormPicture,
//        ]);

//    public static function saveFile($file, string $path) : ?string
//    {
//        return isset($file) ? Storage::disk('public')->putFileAs($path, $file, Carbon::now()->timestamp.'_'.$file->getClientOriginalName()) : null;
//    }
//
//    public static function updateFile($file, string $path, string $oldValue) : ?string
//    {
//        return isset($file) ? Storage::disk('public')->putFileAs($path, $file, Carbon::now()->timestamp.'_'.$file->getClientOriginalName()) : $oldValue;
//    }
//
//    public static function removeFile(string $path) : Boolean
//    {
//        return Storage::disk('public')->exists($path) ? Storage::disk('public')->delete($path) : false;
//    }

}
