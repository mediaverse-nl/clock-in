<?php

namespace App\Providers;

use App\Clocked;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    protected $notificationClocked = [];

    protected $clocked;
    protected $user;

    public function __construct()
    {
        $this->clocked = new Clocked();
    }

    function notificationClocked()
    {
        return Auth::user()
            ->clocked()
            ->take(6)
            ->orderBy('id','desc')
            ->get();
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('components.menu-main', function ($view) {
            $view->with('notificationClocked', $this->notificationClocked());
        });
    }
}
