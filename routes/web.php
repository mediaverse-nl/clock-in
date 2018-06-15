<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/payroll', 'PayrollController@index')->name('payroll.index');
    Route::get('/payroll/{id}', 'PayrollController@show')->name('payroll.show');
    Route::get('/payroll/{id}/edit', 'PayrollController@edit')->name('payroll.edit');

    Route::get('/card', 'CardController@index')->name('card.index');

    Route::resource('user', 'UserController');
    //add card
    //add account
    //check account
    //
});



Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware(['checkForUser', 'auth']);
Route::post('/clocked', 'ClockedController@check')->name('clocked.check')->middleware('checkForUser');

