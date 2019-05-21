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

Route::get('test', function (){
    $response= response()
        ->json([
            'message' => 'je gaat slagen als je dit leest!... let me know.   p.s. bokinopico was awesome  ',
            'status' => 201,
        ], 201);
    $response->header('Content-Type', 'application/json');
    return $response;
 });
Route::post('device-service-touch', 'Api\DeviceController@touch')->middleware('ipCheck');
Route::post('device-rfid', 'Api\DeviceController@rfid')->middleware('ipCheck');
Route::post('device-numpad', 'Api\DeviceController@numpad')->middleware('ipCheck');

