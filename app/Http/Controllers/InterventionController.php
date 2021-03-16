<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public function index()
    {
        return view('interventions/interventions');
    }

    public function create()
    {
        $devices = Device::all();
        $users = User::all();
        return view('interventions/interventions-create')->with(compact('users', 'devices'));
    }

    public function store(Request $request)
    {
       //
    }
}
