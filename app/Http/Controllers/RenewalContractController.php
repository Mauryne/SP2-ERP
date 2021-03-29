<?php

namespace App\Http\Controllers;

use App\Models\RenewalContract;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RenewalContractController extends Controller
{
    public function store(Request $request)
    {
        RenewalContract::create([
            'duration' => $request->input('renewalContractDuration'),
            'signatureDate' => Carbon::parse($request->input('renewalContractDate'))->format('Y-m-d'),
            'contract_id' => $request->input('contract'),
        ]);

        return redirect()->back();
    }
}
