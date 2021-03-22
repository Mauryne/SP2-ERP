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
use App\Models\Type;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request, ContractRequest $contractRequest, EuropeanNormRequest $europeanNormRequest, InstallationRequest $installationRequest, GuaranteeRequest $guaranteeRequest, DeviceRequest $deviceRequest)
    {
        if ($request->hasFile('europeanNormPicture')) {
            //$europeanNormRequest->validated();
            $europeanNormPicture = time() . '_' . $request->serialNumber . '_' . $request->productReference . '.' . $request->europeanNormPicture->extension();
            $request->europeanNormPicture->move(public_path('storage'), $europeanNormPicture);
            $europeanNorm = EuropeanNorm::create([
                'picture_path' => $europeanNormPicture,
            ]);
        }

        if ($request->hasFile('installationPicture')) {
            //$installationRequest->validated();
            $installationPicture = time() . '_' . $request->serialNumber . '_' . $request->productReference . '.' . $request->installationPicture->extension();
            $request->installationPicture->move(public_path('storage'), $installationPicture);
            $installation = Installation::create([
                'picture_path' => $installationPicture,
                'date' => Carbon::parse($request->input('installationDate'))->format('Y-m-d'),
                'summary' => $request->input('installationSummary'),
                'user_id' => $request->input('technician'),
            ]);
        }

        if (null != $request->installationSummary) {
            //$contractRequest->validated();
            $contract = Contract::create([
                'initialDuration' => $request->input('contract'),
                'customer_id' => $request->input('customer'),
            ]);

            //$deviceRequest->validated();
            $device = Device::create([
                'serialNumber' => strtoupper($request->input('serialNumber')),
                'productReference' => strtoupper($request->input('productReference')),
                'saleDate' => Carbon::parse($request->input('saleDate'))->format('Y-m-d'),
                'installation_id' => $installation->id,
                'type_id' => $request->input('type'),
                'customer_id' => $request->input('customer'),
                'europeanNorm_id' => $europeanNorm->id,
                'contract_id' => $contract->id,
            ]);

            //$guaranteeRequest->validated();
            Guarantee::create([
                'initialDuration' => $request->input('guarantee'),
                'device_id' => $device->id,
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
            ]);
        }

        return redirect()->route('devices');
    }
}
