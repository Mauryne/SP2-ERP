<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\ContractCustomerDevice;
use App\Models\Customer;
use App\Models\Device;
use App\Models\DeviceSupply;
use App\Models\Intervention;
use App\Models\InterventionUser;
use App\Models\RenewalContract;
use App\Models\Sale;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customers/customers');
    }

    public function create()
    {
        return view('customers/customers-create');
    }

    public function store(Request $request)
    {
        Customer::create([
            'name' => $request->input('name'),
            'streetNumber' => $request->input('streetNumber'),
            'street' => $request->input('street'),
            'postalCode' => $request->input('postalCode'),
            'city' => $request->input('city'),
            'telephoneNumber' => $request->input('telephoneNumber'),
            'email' => $request->input('email'),
        ]);
        return redirect('customers');
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers/customers-update')->with(compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        $customer->name = $request->input('name');
        $customer->streetNumber = $request->input('streetNumber');
        $customer->street = $request->input('street');
        $customer->postalCode = $request->input('postalCode');
        $customer->city = $request->input('city');
        $customer->telephoneNumber = $request->input('telephoneNumber');
        $customer->email = $request->input('email');
        $customer->save();

        return redirect('customers');
    }

    public function destroy($id)
    {
        $devices = Device::all()->where('customer_id', 'LIKE', $id);
        $contractsCustomersDevices = ContractCustomerDevice::all()->where('customer_id', 'LIKE', $id);
        $sales = Sale::all()->where('customer_id', 'LIKE', $id);
        $contracts = Contract::all()->where('customer_id', 'LIKE', $id);

        foreach ($contractsCustomersDevices as $contractCustomerDevice) {
            $contractCustomerDevice->delete();
        }

        foreach ($devices as $device) {
            $interventions = Intervention::all()->where('device_id', 'LIKE', $device->id);
            foreach ($interventions as $intervention) {
                $interventionsUsers = InterventionUser::all()->where('maintenance_id', $intervention->id);
                foreach ($interventionsUsers as $interventionUser) {
                    $interventionUser->delete();
                }
                $intervention->delete();
            }
            $salesDevices = Sale::all()->where('device_id', 'LIKE', $device->id);
            foreach ($salesDevices as $saleDevice) {
                $saleDevice->delete();
            }
            $devicesSupplies = DeviceSupply::all()->where('device_id', 'LIKE', $device->id);
            foreach($devicesSupplies as $deviceSupply)
            {
                $deviceSupply->delete();
            }
            $device->delete();
        }

        foreach ($sales as $sale) {
            $sale->delete();
        }

        foreach ($contracts as $contract) {
            $renewalContracts = RenewalContract::all()->where('contract_id', 'LIKE', $contract->id);
            foreach ($renewalContracts as $renewalContract) {
                $renewalContract->delete();
            }
            $contract->delete();
        }

        Customer::find($id)->delete();
        return redirect('customers');
    }
}
