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
Route::get('test', function (){
    $responseCode = 201;
    $responseData = [
        'message' => 'test het werkt',
        'status' => $responseCode,
    ];
    $header = [
        'Content-Type' => 'application/json; charset=UTF-8',
        'charset' => 'utf-8'
    ];
    return response()
        ->json($responseData, $responseCode, $header, JSON_UNESCAPED_UNICODE);
});
Route::post('device-service-touch', 'Api\DeviceController@touch')->middleware('ipCheck');
Route::post('device-rfid', 'Api\DeviceController@rfid')->middleware('ipCheck');
Route::post('device-numpad', 'Api\DeviceController@numpad')->middleware('ipCheck');

