<?php

namespace App\Http\Controllers\Api;

use App\Card;
use App\Clocked;
use App\Devices;
use App\Traits\ApiResponse;
use App\Traits\ClockIn;
use App\User;
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

         $device_id = $this->clocked()->getDeviceFromMacAddress($request->mac_address);

//        dd($device_id);
        if (true){
            $device = Devices::where('id', '=', $device_id)->first();
k
//            dd($device);
        }

        $card = (new Card())
            ->where('value','=', $request->rfid_tag);

        if ($card->exists()){
            $user_id = $card->first()->user_id;

            $entry = (new Clocked())
                ->where('active', '=', 1)
                ->where('user_id', '=', $user_id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($entry){
                $worked_min = $this->time()->diffInMinutes($entry->started_at);
                $entry->stopped_at = $this->time()->toDateTimeString();
                $entry->worked_min = $worked_min;
                $entry->device_id = $device_id;
                $entry->started_at = $this->time()->toDateTimeString();
                $entry->active = 0;
                $entry->save();

                return response()
                    ->json([
                        'data' => [
                            'min_gewerkt' => $worked_min
                        ],
                        'message' => 'uitgecheckt',
                        'status' => 200,
                    ], 200);
            }else{
                $clocked = $this->clocked();
                $clocked->device_id = $device_id;
                $clocked->started_at = $this->time()->toDateTimeString();
                $clocked->user_id = $user_id;
                $clocked->save();

                return response()
                    ->json([
                        'message' => 'ingecheckt',
                        'status' => 201,
                    ], 201);
            }
        }else{
            $card = (new Card());
            $card->user_id = null;
            $card->value = $request->rfid_tag;
            $card->save();

            return response()
                ->json([
                    'error' => 'tag niet gevonden',
                    'status' => 404,
                ], 404);
        }
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

        $user = (new User())
            ->where('clock_in_code', '=', $request->clock_in_code);

        if ($user->exists()){
            $user_id = $user->first(['id'])->id;

            $entry = (new Clocked())
                ->where('active', '=', 1)
                ->where('user_id', '=', $user_id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($entry){
                $worked_min = $this->time()->diffInMinutes($entry->started_at);
                $entry->stopped_at = $this->time()->toDateTimeString();
                $entry->worked_min = $worked_min;
                $entry->device_id = $this->clocked()->getDeviceFromMacAddress($request->mac_address);
                $entry->started_at = $this->time()->toDateTimeString();
                $entry->active = 0;
                $entry->save();

                return response()
                    ->json([
                        'data' => [
                            'min_gewerkt' => $worked_min
                        ],
                        'message' => 'uitgecheckt',
                        'status' => 200,
                    ], 200);
            }else{
                $clocked = $this->clocked();
                $clocked->device_id = $this->clocked()->getDeviceFromMacAddress($request->mac_address);
                $clocked->started_at = $this->time()->toDateTimeString();
                $clocked->user_id = $user_id;
                $clocked->save();

                return response()
                    ->json([
                        'message' => 'ingecheckt',
                        'status' => 201,
                    ], 201);
            }
        }else{
            return response()
                ->json([
                    'error' => 'code niet gevonden',
                    'status' => 404,
                ], 404);
        }
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
