<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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

    public function update (Request $request, $id)
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
}
