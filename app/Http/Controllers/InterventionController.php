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
        $users = json_decode(file_get_contents('http://' . $_ENV["API_IP"] . ':8000/api/users'), true);
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

        foreach ($request->user as $user) {
            InterventionUser::create(
                ['user_id' => $user,
                    'maintenance_id' => $intervention->id,
                ]);
        }
        return redirect('interventions');
    }

    public function edit($id)
    {
        $intervention = Intervention::find($id);
        $devices = Device::all()->where('installation_id', '!=', null);
        $users = json_decode(file_get_contents('http://' . $_ENV["API_IP"] . ':8000/api/users'), true);

        return view('interventions/interventions-update')->with(compact('users', 'devices', 'intervention'));
    }

    public function update(Request $request, $id)
    {
        $intervention = Intervention::find($id);
        $intervention->streetNumber = $request->input('streetNumber');
        $intervention->street = $request->input('street');
        $intervention->postalCode = $request->input('postalCode');
        $intervention->city = $request->input('city');
        $intervention->date = Carbon::parse($request->input('date'))->format('Y-m-d');
        $intervention->comment = ucfirst(strtolower($request->input('comment')));
        $intervention->externalProvider = $request->input('externalProvider');
        $intervention->device_id = $request->input('device');
        $intervention->save();

        InterventionUser::where('maintenance_id', $id)->delete();

        foreach ($request->user as $user) {
            InterventionUser::create(
                ['user_id' => $user,
                    'maintenance_id' => $id,
                ]);
        }

        return redirect('interventions');
    }

    public function destroy($id)
    {
        $interventionsUsers = InterventionUser::all()->where('maintenance_id', $id);
        foreach ($interventionsUsers as $interventionUser) {
            $interventionUser->delete();
        }
        Intervention::find($id)->delete();
        return redirect('interventions');
    }
}
