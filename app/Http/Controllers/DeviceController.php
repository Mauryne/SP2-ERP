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

    public function uploadFile(Request $request, $field)
    {
        return $request->file($field)->store('public');
    }

    public function store(Request $request)
    {
        EuropeanNorm::create([
           'picture' =>  $request->file('file')->getClientOriginalName(),
        ]);
//        Device::create();
//        $europeanNorm = EuropeanNorm::create();
//        $installation = Installation::create();
//        Contract::create();
//        ContractCustomerDevice::create();
//
//        $this->storeImageEuropeanNorm($europeanNorm);
//        $this->storeImageInstallation($installation);

        return redirect()->route('devices/devices');
    }
}
