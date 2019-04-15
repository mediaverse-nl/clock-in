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
Route::post('device-service-touch', 'Api\DeviceController@touch');
Route::post('device-rfid', 'Api\DeviceController@rfid');
Route::post('device-numpad', 'Api\DeviceController@numpad');
//    rfid_tag
//    mac_addres
//    ip_address
