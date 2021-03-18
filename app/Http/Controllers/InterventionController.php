<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Intervention;
use App\Models\InterventionUser;
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
        $devices = Device::all()->where('installation_id', '!=', null);
        $users = User::all();
        return view('interventions/interventions-create')->with(compact('users', 'devices'));
    }

    public function store(Request $request)
    {
        $intervention = Intervention::create([
            'streetNumber' => $request->input('streetNumber'),
            'street' => $request->input('street'),
            'postalCode' => $request->input('postalCode'),
            'city' => $request->input('city'),
            'date' => Carbon::parse($request->input('date'))->format('Y-m-d'),
            'comment' => $request->input('comment'),
            'externalProvider' => $request->input('externalProvider'),
            'device_id' => $request->input('device'),
        ]);

        foreach($request->user as $user)
        {
            InterventionUser::create(
                ['user_id' => $user,
                    'maintenance_id' => $intervention->id,
                ]);
        }
        return redirect('interventions')->with('success', 'L\'intervention a été programmée.');
    }
}
