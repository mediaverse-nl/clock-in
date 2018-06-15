<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cards()
    {
        return $this->hasMany('App\Card');
    }

    public function clocked()
    {
        return $this->hasMany('App\Clocked');
    }

    public function isClockedIn()
    {
       $status = $this->clocked()
            ->where('active', '=', 1)
            ->exists();

        if($status){
            return 'in';
        }

        return 'out';
    }

    public function payrollThisMonth()
    {
        return $this->clocked()
            ->thisMonth()
            ->sum('worked_min');
//            ->sum('worked_min');
    }


}
