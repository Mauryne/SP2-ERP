<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\Supply;

class StatisticController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        $purchases = Purchase::all();
        $providers = Provider::all();
        $supplies = Supply::all();
        return view('statistics/statistics')->with(compact('sales', 'purchases', 'providers', 'supplies'));
    }
}
