<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Intervention;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public function index()
    {
        return view('interventions/interventions');
    }

    public function create()
    {
        $devices = Device::all()->where('installation_id','!=', null);
        $users = User::all();
        return view('interventions/interventions-create')->with(compact('users', 'devices'));
    }

    public function store(Request $request)
    {
        Intervention::create([
            'streetNumber' => $request->input('streetNumber'),
            'street' => $request->input('street'),
            'postalCode' => $request->input('postalCode'),
            'city' => $request->input('city'),
            'date' => Carbon::parse($request->input('date'))->format('Y-m-d'),
            'actions' => '',
            'device_id' => $request->input('device'),
            //'user_id' => $request->input('user'),
        ]);
        return redirect('interventions')->with('success', 'L\'intervention a été programmée.');
    }
}
