<?php

namespace App\Http\Controllers;

use App\Models\RenewalGuarantee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RenewalGuaranteeController extends Controller
{
    public function store(Request $request)
    {
        RenewalGuarantee::create([
            'duration' => $request->input('newRenewalGuaranteeDuration'),
            'signatureDate' => Carbon::parse($request->input('newRenewalGuaranteeDate'))->format('Y-m-d'),
            'guarantee_id' => $request->input('guarantee'),
        ]);

        return redirect()->back();
    }
}