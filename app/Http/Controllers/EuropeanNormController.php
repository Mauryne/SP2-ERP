<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\EuropeanNorm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EuropeanNormController extends Controller
{
    public function store(Request $request, $id)
    {
        $device = Device::find($id);
        $europeanNormId = $device->europeanNorm_id;

        if ($europeanNormId != null) {
            if ($request->hasFile('newEuropeanNormPicture')) {
                $europeanNormPicture = 'European_norm_' . time() . '_' . $device->serialNumber . '_' . $device->productReference . '.' . $request->newEuropeanNormPicture->extension();
                $request->newEuropeanNormPicture->move(public_path('storage'), $europeanNormPicture);
                $europeanNorm = EuropeanNorm::find($europeanNormId);
                $europeanNorm->picture_path = $europeanNormPicture;
                $europeanNorm->save();

                return redirect()->route('devices.edit', $device->id);
            }
        }
    }
}
