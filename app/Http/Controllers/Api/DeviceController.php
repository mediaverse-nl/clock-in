<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use App\Traits\ClockIn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeviceController extends Controller
{
    use ApiResponse, ClockIn;

    public function rfid(Request $request)
    {
        $errors = $this->checkForErrors($request, [
            'mac_address' => 'required|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
            'ip_adress' => 'required|ip',
            'rfid_tag' => 'required',
        ]);

        if (!empty($errors)){
            return $errors;
        }

        return $this->check($request, 'rfid_tag');
//        rfid_tag

//        return 'ok';
    }

    public function numpad(Request $request)
    {
        $errors = $this->checkForErrors($request, [
            'mac_address' => 'required|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
            'ip_adress' => 'required|ip',
            'clock_in_code' => 'required',
        ]);

        if (!empty($errors)){
            return $errors;
        }

        //

        return response()->json([
            'message' => 'ok',
            'status' => $httpStatus
        ], $httpStatus);
    }

    public function touch(Request $request)
    {
        $errors = $this->checkForErrors($request, [
            'mac_address' => 'required|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
            'version' => 'required',
            'ip_adress' => 'required|ip'
        ]);

        if (!empty($errors)){
            return $errors;
        }

        $device = new \App\Devices();

        $newDevice = $device->firstOrNew([
            'mac_address' => $request->mac_address
        ]);

        if (!$newDevice->exists){
            $httpStatus = 201;//Aangemaakt
            $newDevice->version = $request->version;
            $newDevice->mac_address = $request->mac_address;
            $newDevice->serial_nr = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
        }else{
            $httpStatus = 202;//Aanvaard
            $newDevice->version = $request->version;
        }
        $newDevice->save();

        return response()->json([
            'message' => 'ok',
            'status' => $httpStatus
        ], $httpStatus);
    }
}
