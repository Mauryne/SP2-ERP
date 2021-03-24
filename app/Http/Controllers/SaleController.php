<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::all();
        return view('sales/sales-map')->with(compact('sales'));
    }
}
