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

Route::get('/', 'WelcomeController')->name('home');
Route::get('/contact', 'ContactController@index')->name('contact.index');
Route::get('/diensten', function (){
    return view('site.services');
})->name('service.index');

Route::get('/system', function (){
    return view('site.system');
})->name('system.index');

Route::get('/about', function (){
    return view('site.about');
})->name('about.index');

Route::get('/roadmap', function (){
    return view('site.roadmap');
})->name('roadmap.index');

Route::get('/privacy-policy', function (){
    return view('site.privacy');
})->name('privacy.index');

Route::get('/terms-of-use', function (){
    return view('site.terms');
})->name('terms.index');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::get('password/change', 'Auth\ChangePasswordController@showChangePasswordForm')->name('password.change.form');
Route::post('password/change', 'Auth\ChangePasswordController@changePassword')->name('password.postChangePassword');

Route::prefix('super-admin')->middleware(['auth'])->name('super.')->namespace('SuperAdmin')->group(function () {
    Route::get('/', 'DashboardController');
    Route::get('/dashboard', 'DashboardController')->name('dashboard');
    Route::resource('business', 'BusinessController');
    Route::resource('package', 'PackagesController');
    Route::get('/l-{id}/device/create', 'DeviceController@create')->name('device.create');
    Route::resource('device', 'DevicesController', ['only' => [
        'destroy', 'store', 'edit', 'update'
    ]]);
    Route::get('/b-{id}/function/create', 'FunctionController@create')->name('function.create');
    Route::resource('function', 'FunctionController', ['only' => [
        'destroy', 'store', 'edit', 'update'
    ]]);
    Route::get('/b-{id}/user/create', 'UserController@create')->name('user.create');
    Route::resource('user', 'UserController', ['only' => [
        'destroy', 'store', 'edit', 'update'
    ]]);
    Route::resource('settings', 'PackagesController');
    Route::get('/b-{id}/location/create', 'LocationsController@create')->name('location.create');
    Route::resource('location', 'LocationsController', ['only' => [
        'destroy', 'store', 'edit', 'update'
    ]]);
});

Route::prefix('panel')->middleware(['auth'])->namespace('Panel')->group(function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/mijn-dashboard', 'DashboardController@show')->name('auth.dashboard');

//    Route::get('/payroll', 'PayrollController@index')->name('payroll.index');
//    Route::get('/payroll/{id}', 'PayrollController@show')->name('payroll.show');
//    Route::get('/payroll/{id}/edit', 'PayrollController@edit')->name('payroll.edit');

    Route::get('/card', 'CardController@index')->name('card.index');
    Route::get('/card/{id}', 'CardController@show')->name('card.show');
    Route::get('/card/{id}/edit', 'CardController@edit')->name('card.edit');
    Route::patch('/card/{id?}', 'CardController@update')->name('card.update');
    Route::delete('/card/{id?}', 'CardController@destroy')->name('card.destroy');


//    Route::resource('mail', 'MailController');
    Route::patch('/user/add-card', 'UserController@addCard')->name('user.update.card');
    Route::resource('user', 'UserController');
    Route::resource('calendar', 'CalendarController');

    Route::get('/clocked', 'ClockedController@index')->name('clocked.index');
    Route::get('/clocked/{id}', 'ClockedController@show')->name('clocked.show');
    Route::get('/clocked/{id}/edit', 'ClockedController@edit')->name('clocked.edit');
    Route::patch('/clocked/{id}/stop', 'ClockedController@stopTimer')->name('clocked.stopTimer');
    Route::patch('/clocked/{id}/start', 'ClockedController@startTimer')->name('clocked.startTimer');
    Route::patch('/clocked/{id}/update', 'ClockedController@update')->name('clocked.update');

    Route::get('test', function (){
        $users = User::select('id', 'name', 'email', 'created_at')->get();

        Excel::create('users', function($excel) use($users) {
            $excel->setTitle('My awesome report 2016');
            // Chain the setters
            $excel->setCreator('Me')->setCompany('Our Code World');

            $excel->setDescription('A demonstration to change the file properties');


            $start_row = 2;

            $row = $start_row;

            foreach ($users as $user)
            {
                $excel->sheet($user->name, function($sheet) use($user, $row)
                {
                    $clocked = $user->clocked->ThisMonth();

                    $sheet->setCellValue('A1', 'start');
                    $sheet->setCellValue('B1', 'stop');
                    $sheet->setCellValue('C1', 'totaal gewerkte min');

                    $sheet->setCellValue('D1', $clocked->sum('worked_min'));

                    $sheet->fromArray(
                        array_except($user->toArray(),
                            ['id', 'clocked', 'created_at', 'updated_at']
                        ),
                        null,
                        'G3',
                        false,
                        false
                    );

                    foreach ($clocked as $clock)
                    {
                        $sheet->row($row, array_except($clock->toArray(),
                            ['created_at', 'updated_at', 'user_id', 'active', 'id']
                        ));

                        $row++;
                    }
                });
                $row = $start_row;
            }
//            $excel->sheet('Sheet 2', function($sheet) use($users) {
//                $sheet->fromArray($users->take(2));
//            });
        })->export('xls');
    });
});



//Route::get('/dashboard', 'DashboardController@index')->middleware(['checkForUser', 'auth']);
Route::post('/clocked', 'ClockedController@check')->name('clocked.check')->middleware('checkForUser');
Route::get('/check-status', function (){
    return 'ok';
});
Route::post('/check-status', function (){
    return 'ok';
});

