<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('map');
    }
}
