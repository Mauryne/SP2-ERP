<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InterventionController extends Controller
{
    public function index()
    {
        return view('interventions');
    }
}
