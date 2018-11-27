<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//    201: Aangemaakt
//    202: Aanvaard
//    200: OK
//    ip_adress
//    version
//    mac_address
Route::post('device-service-touch', function (Request $request) {

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
        'status' => 'ok'
    ], $httpStatus);
});

Route::get('device-rfid', function () {
//    rfid_tag
//    mac_addres
    return 'ok';
});

Route::get('device-numpad', function () {

    $httpStatus = 202; //Aanvaard



    //    clock_in_code
    //    mac_addres
    return response()->json([
        'status' => 'ok'
    ], $httpStatus);
});