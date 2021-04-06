<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Installation;
use Illuminate\Http\Request;

class InstallationController extends Controller
{
    public function store(Request $request, $id)
    {
        $device = Device::find($id);
        $installationId = $device->installation_id;

        if ($installationId != null) {
            if ($request->hasFile('newInstallationPicture')) {
                $installationPicture = 'Installation_' . time() . '_' . $device->serialNumber . '_' . $device->productReference . '.' . $request->newInstallationPicture->extension();
                $request->newInstallationPicture->move(('storage'), $installationPicture);
                $installation = Installation::find($installationId);
                $installation->picture_path = $installationPicture;
                $installation->save();

                return redirect()->route('devices.edit', $device->id);
            }
        }
    }
}
