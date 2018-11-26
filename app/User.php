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

    public function userFunctions()
    {
        return $this->hasMany('App\UserFunctions', 'user_id', 'id');
    }

    public function clocked()
    {
        return $this->hasMany('App\Clocked');
    }

    public function userRoles()
    {
        return $this->hasMany('App\UserRole');
    }

    public function business()
    {
        return $this->belongsTo('App\Business');
    }

    public function hasAccess($permissions)
    {
        foreach ($this->userRoles as $role) {
            if(in_array($role->role->value, $permissions)) {
                return true;
            }
        }
    }

    public function workingTime()
    {
        $workedMin = $this->clocked()->where('active', '=', 0)->sum('worked_min');
        $hours = number_format(floor($workedMin / 60), 0);
        $min = number_format( $workedMin - $hours * 60  );

        if ($min <= 9){
            $min = '0'.$min;
        }

        return $hours.':'.$min;
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
//        $user = $this->where('id','=',$user_id)->first();
//        $clocked = new Clocked();
//
//        $dateStart = Carbon::now(); // or $date = new Carbon();
//        $dateStart->setISODate($dateStart->year, $weeknumber); // 2016-10-17 23:59:59.000000
//
//        $dateEnd = Carbon::now(); // or $date = new Carbon();
//        $dateEnd->setISODate($dateStart->year, $weeknumber); // 2016-10-17 23:59:59.000000
//
//        $clocked = DB::table('clocked')
//            ->where('user_id', '=', $user_id)
//            ->where('started_at', '>', $dateStart->startOfWeek())
//            ->where('stopped_at', '<', $dateEnd->endOfWeek())
//            ->orderBy('stopped_at','asc')
//            ->orderBy('started_at','desc')
//            ->select(
////                'started_at',
////                'stopped_at',
////                'worked_min',
//                DB::raw('sum(worked_min) as total'),
//                DB::raw("DATE(started_at) as date"),
//                DB::raw("DAYNAME(started_at) as day")
//            )
//            ->groupBy('date')
//            ->get();
//
//        $barChart = [];
//        for ($x = 0; $x <= 7; $x++){
//
//            $barChart[] = [
//                'day'=> '',
//                'worked'=> '',
//                'brake'=> '',
//            ];
//        }
//
//        return $clocked;




//


//        return $clocked->groupBy('started_at')->select('*', DB::raw('count(*) as total'));
    }


}
