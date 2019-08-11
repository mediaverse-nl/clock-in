<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MultiDomainServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $domainParts = explode(".",$_SERVER['HTTP_HOST']);
        $subDomain = array_shift($domainParts);
        //dd($subDomain, config('database.connections.mysql.database'));
        //todo add migrations and database creation here based on subdomain if subdomain found and config set to multi
    }
}
