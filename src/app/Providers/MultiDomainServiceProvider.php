<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MultiDomainServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $subDomain = self::getSubdomain();

        if(config('app.multitenant')) {

            try {
                //does the connection work with the user / db set above?
                DB::connection('mysql')->getPdo();
            } catch (\Exception $e) {

                //todo run this on a queue

                //todo add guzzle call here to verify if the client/$subDomain is valid

                //does not work.. create the database and user
                try {
                    $pwd = config('app.multitenant_default_pwd');
                    DB::connection('mysql_root')->statement("CREATE DATABASE $subDomain DEFAULT CHARACTER SET utf8;");
                    DB::connection('mysql_root')->statement("CREATE USER '$subDomain'@'%' IDENTIFIED BY '$pwd';");
                    DB::connection('mysql_root')->statement("GRANT ALL PRIVILEGES ON `$subDomain`. * TO '$subDomain'@'%';");
                    DB::connection('mysql_root')->statement("FLUSH PRIVILEGES;");

                    Artisan::call('migrate', ['--force' => true, '--seed' => true ]);

                } catch (\Exception $e) {
                    //couldnt create user or database.. log error
                    Log::critical("2000: UNABLE TO CREATE TENANT DB EXCEPTION: ".$e->getCode()." MESSAGE: ".$e->getMessage());
                }

            }

            //dd('gg', DB::connection('mysql_root'), $subDomain);
        }

    }

    private static function getSubdomain() {
        $domainParts = explode(".",$_SERVER['HTTP_HOST']);
        return array_shift($domainParts);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {


        $subDomain = self::getSubdomain();

        if(config('app.multitenant')) {

            //overwrite default database and db user
            config([
                'database.connections.mysql.database' => $subDomain,
                'database.connections.mysql.username' => $subDomain
            ]);
        }
    }
}
