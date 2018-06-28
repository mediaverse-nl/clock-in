<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordToken;
use Illuminate\Support\Facades\DB;

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

    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    public function calendar()
    {
        return $this->hasMany('App\Calendar');
    }

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

    public function barChartThisWeek($weeknumber, $user_id){
        $user = $this->where('id','=',$user_id)->first();
        $clocked = new Clocked();

        $dateStart = Carbon::now(); // or $date = new Carbon();
        $dateStart->setISODate($dateStart->year, $weeknumber); // 2016-10-17 23:59:59.000000

        $dateEnd = Carbon::now(); // or $date = new Carbon();
        $dateEnd->setISODate($dateStart->year, $weeknumber); // 2016-10-17 23:59:59.000000
//
        return DB::table('clocked')
            ->where('user_id', '=', $user_id)
            ->where('started_at', '>', $dateStart->startOfWeek())
            ->where('started_at', '<', $dateEnd->endOfWeek())
            ->select('*', DB::raw('sum(started_at) as total'))
            ->groupBy(DB::raw("DAY(started_at)"))
            ->get();

        return $clocked->groupBy('started_at')->select('*', DB::raw('count(*) as total'));

//        return $user
//            ->clocked()
//            ->select('*', DB::raw('sum(worked_min) as worked'))
////            ->get()
//            ->groupBy(function($date) {
//                return Carbon::parse($date->started_at)->format('W');
//            })->orderby('w')
//            ;
    }


}
