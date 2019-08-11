<?php

namespace App\Http\Controllers\Api;

use App\Card;
use App\Clocked;
use App\Devices;
use App\Traits\ApiResponse;
use App\Traits\ClockIn;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeviceController extends Controller
{
    use ApiResponse, ClockIn;

    public function rfid(Request $request)
    {
        $errors = $this->checkForErrors($request, [
            'mac_address' => 'required|regex:/^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$/',
            'rfid_tag' => 'required',
        ]);

        if (!empty($errors)){
            return $errors;
        }

        $mac = $this->clocked()->getDeviceFromMacAddress($request->mac_address);

        if ($mac == null){
            return response()
                ->json([
                    'message' => 'apparaat niet bekend in systeem',
                    'status' => 403
                ], 403);
        }

        $card = (new Card())
            ->where('value','=', $request->rfid_tag);

        if ($card->exists()){

            $user_id = $card->first()->user_id;

            if ($user_id === null){
                $card->delete();

                $card = (new Card());
                $card->user_id = null;
                $card->value = $request->rfid_tag;
                $card->save();

                return response()
                    ->json([
                        'message' => 'kaart niet gekoppeld aan gebruiker',
                        'status' => 407,
                    ], 407);
            }

            $entry = (new Clocked())
                ->where('active', '=', 1)
                ->where('user_id', '=', $user_id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($entry){
                $worked_min = $this->time()->diffInMinutes($entry->started_at);
                $entry->stopped_at = Carbon::now();
                $entry->worked_min = $worked_min;
                $entry->device_id = $this->clocked()->getDeviceFromMacAddress($request->mac_address);
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
                $clocked->device_id = $mac;
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
            'clock_in_code' => 'required',
        ]);

        if (!empty($errors)){
            return $errors;
        }

        $mac = $this->clocked()->getDeviceFromMacAddress($request->mac_address);

        if ($mac == null){
            return response()
                ->json([
                    'message' => 'apparaat niet bekend in systeem',
                    'status' => 403
                ], 403);
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
                $entry->stopped_at = Carbon::now();
                $entry->worked_min = $worked_min;
                $entry->device_id = $mac;
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
