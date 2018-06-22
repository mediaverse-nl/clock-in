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

use App\User;

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('panel')->middleware(['auth'])->namespace('Panel')->group(function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/payroll', 'PayrollController@index')->name('payroll.index');
    Route::get('/payroll/{id}', 'PayrollController@show')->name('payroll.show');
    Route::get('/payroll/{id}/edit', 'PayrollController@edit')->name('payroll.edit');

    Route::get('/card', 'CardController@index')->name('card.index');
    Route::get('/card/{id}', 'CardController@show')->name('card.show');
    Route::get('/card/{id}/edit', 'CardController@edit')->name('card.edit');
    Route::patch('/card/{id?}', 'CardController@update')->name('card.update');
    Route::delete('/card/{id?}', 'CardController@destroy')->name('card.destroy');

    Route::resource('user', 'UserController');
    //add card
    //add account
    //check account
    //

    Route::get('test', function (){
        $users = User::select('id', 'name', 'email', 'created_at')->get();

        Excel::create('users', function($excel) use($users) {
            $excel->setTitle('My awesome report 2016');
            // Chain the setters
            $excel->setCreator('Me')->setCompany('Our Code World');

            $excel->setDescription('A demonstration to change the file properties');


            $excel->sheet('Sheet 1', function($sheet) use($users) {
                $sheet->fromArray($users->take(5));
            });
            $excel->sheet('Sheet 2', function($sheet) use($users) {
                $sheet->fromArray($users->take(2));
            });
        })->export('xls');

    });
});



//Route::get('/dashboard', 'DashboardController@index')->middleware(['checkForUser', 'auth']);
Route::post('/clocked', 'ClockedController@check')->name('clocked.check')->middleware('checkForUser');

