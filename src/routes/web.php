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
//use Storage;

Route::get('/firmware-wemos/{name}.bin', function (\Illuminate\Http\Request $request){

    $firmware = \App\Firmware::all()->sortByDesc('id')->first();

    $mac_address = '';
    $ip_address = '';
    $currentVersion = str_replace('V', '', strtoupper($firmware->app_version));
    $thisVersion = str_replace('V', '', strtoupper($request->request->get('v')));

//    dd(
//        $currentVersion,
//        $thisVersion,
//        version_compare($thisVersion, $currentVersion) >= 0
//    );

    //testing
    //    $files = scandir(__DIR__.'/../storage/app/public/firmware/', SCANDIR_SORT_DESCENDING);
    //    $files = array_diff($files, [".", ".."]);
    //    $newest_file = $files[0];

    $file = storage_path('app/'.$firmware->path);

    if (version_compare($thisVersion, $currentVersion ) >= 0){
        return response('', 304);
    }

    $headers = [
        'Content-Type: application/octet-stream',
        'Content-Length',
    ];

    return response()->download($file, 'wemos.bin', $headers);

});


Route::get('/', 'WelcomeController')->name('home');
Route::get('/contact', 'ContactController@index')->name('contact.index');
Route::get('/services', function (){
    return view('site.services');
})->name('service.index');

Route::get('/system', function (){
    return view('site.system');
})->name('system.index');

Route::get('/over-ons', function (){
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

Route::get('/terms-of-use', function (){
    return view('site.terms');
})->name('terms.index');

Route::domain('app.clock-on.nl')->name('app.')->namespace('App')->group(function () {
    Route::get('/dashboard', 'DashboardController')->name('dashboard');
    Route::get('/rooster', 'ScheduleController@index')->name('schedule.index');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('logout', 'Auth\LoginController@logout')->name('logoutget');
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
    Route::resource('device', 'DeviceController');
    Route::resource('firmware', 'FirmwareController');
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

//new dashboard user
Route::prefix('panel')->middleware(['auth'])->namespace('Panel')->name('panel.')->group(function () {
    Route::get('/beschikbaarheid', 'AvailabilityController@index')->name('availability.index');
    Route::get('/rooster', 'ScheduleController@index')->name('schedule.index');
});

//new dashboard management
Route::prefix('admin')->middleware(['auth'])->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/', 'DashboardController');
    Route::get('/dashboard', 'DashboardController')->name('dashboard');
    Route::get('/rooster/day', 'ScheduleController@day')->name('schedule.day');
    Route::get('/rooster/week', 'ScheduleController@week')->name('schedule.week');
    Route::get('/rooster/month', 'ScheduleController@month')->name('schedule.month');
    Route::get('/rooster/availability', 'ScheduleController@availability')->name('schedule.availability');
    Route::get('/rooster/departments', 'ScheduleController@departments')->name('schedule.departments');
    Route::get('/team', 'TeamController@index')->name('team.index');
    Route::get('/team/create', 'TeamController@create')->name('team.create');
    Route::get('/team/edit/{id}', 'TeamController@edit')->name('team.edit');
    Route::post('/team', 'TeamController@store')->name('team.store');
    Route::patch('/team/{id}', 'TeamController@update')->name('team.update');
    Route::get('/team/roles', 'TeamController@roles')->name('team.roles');
    Route::get('/reports', 'ReportController@index')->name('report.index');
    Route::get('/settings', 'SettingsController@index')->name('settings.index');
    Route::get('/tijdregistratie', 'TimeTrackingController@index')->name('time-tracking.index');
    Route::post('/change-location', 'LocationController@change')->name('location.change');
    Route::post('/filter-options', 'FilterController@flash')->name('filter.flash');
});

Route::prefix('panel')->middleware(['auth'])->namespace('Panel')->group(function () {

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/mijn-dashboard', 'DashboardController@show')->name('auth.dashboard');

    Route::get('/card', 'CardController@index')->name('card.index');
    Route::get('/card/{id}', 'CardController@show')->name('card.show');
    Route::get('/card/{id}/edit', 'CardController@edit')->name('card.edit');
    Route::patch('/card/{id?}', 'CardController@update')->name('card.update');
    Route::delete('/card/{id?}', 'CardController@destroy')->name('card.destroy');

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

