<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractCustomerDevice;
use App\Models\Customer;
use App\Models\Device;
use App\Models\EuropeanNorm;
use App\Models\Installation;
use App\Models\Type;
use App\Models\User;
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

    public function store(Request $request)
    {
        Device::create($this->validatorDevice());
        $europeanNorm = EuropeanNorm::create($this->validatorEuropeanNorm());
        $installation = Installation::create($this->validatorInstallation());
        Contract::create($this->validatorContract());
        ContractCustomerDevice::create($this->validatorContractCustomerDevice());

        $this->storeImageEuropeanNorm($europeanNorm);
        $this->storeImageInstallation($installation);

        return redirect()->route('devices/devices');
    }

    private function validatorDevice()
    {
        return request()->validate([
            'serialNumber' => 'required|min:3',
            'productReference' => 'required|min:3',
            'installation_id' => 'sometimes|integer',
            'type_id' => 'required|integer',
            'customer_id' => 'sometimes|integer',
            'europeanNorm_id' => 'sometimes|integer',
            'contract_id' => 'sometimes|integer',
        ]);
    }

    private function validatorEuropeanNorm()
    {
        return request()->validate([
            'picture' => 'sometimes|image|max:500',
        ]);
    }

    private function validatorInstallation()
    {
        return request()->validate([
            'picture' => 'sometimes|image|max:500',
            'user_id' => 'required|integer',
        ]);
    }

    private function validatorContract()
    {
        return request()->validate([
            'customer_id' => 'required|integer',
        ]);
    }

    private function validatorContractCustomerDevice()
    {
        return request()->validate([
            'device_id' => 'required|integer',
            'customer_id' => 'required|integer',
            'contract_id' => 'required|integer',
        ]);
    }

    private function storeImageEuropeanNorm(EuropeanNorm $europeanNorm)
    {
        if (request('europeanNormPicture'))
        {
            $europeanNorm->update([
               'picture' => request('europeanNormPicture')->store('europeanNormsPictures', 'public')
            ]);
        }
    }

    private function storeImageInstallation(Installation $installation)
    {
        if (request('installationPicture'))
        {
            $installation->update([
                'picture' => request('installationPicture')->store('installationPictures', 'public')
            ]);
        }
    }
}
