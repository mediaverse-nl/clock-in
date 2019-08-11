<?php

namespace App\Providers;

use App\Clocked;
use App\Location;
use App\Traits\getLocationTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    use getLocationTrait;

    protected $notificationClocked = [];

    protected $clocked;
    protected $user;

    public function __construct()
    {
        $this->clocked = new Clocked();
        $this->location = new Location();
    }

    function notificationClocked()
    {
        return Auth::user()
            ->clocked()
            ->take(6)
            ->orderBy('id','desc')
            ->get();
    }

    function menuUserLocations()
    {
//        dd(1);
        $this->currentLocationId();


        return $this->getLocationsFromUser();
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('includes.*', function ($view) {
            $view->with('notificationClocked', $this->notificationClocked());
        });

        view()->composer('layouts.admin', function ($view) {
            $view->with('menuUserLocations', $this->menuUserLocations());
        });
    }
}
