<?php

namespace App;

use App\Traits\ClockIn;
use App\Traits\getLocationTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Clocked extends Model
{
    use getLocationTrait, ClockIn;

    protected $table = 'clocked';

    protected $dates = [
        'created_at',
        'updated_at',
        'started_at',
        'stopped_at'
    ];

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the user that owns the phone.
     */
    public function device()
    {
        return $this->belongsTo('App\Devices');
    }

    public function diffInTime()
    {
        $to = Carbon::parse($this->started_at);
        $from = Carbon::parse($this->stopped_at);

        $seconds = $to->diffInSeconds($from);
        $minutes = $to->diffInMinutes($from);
        $hours = $to->diffInHours($from);
        $days = $to->diffInDays($from);

        if($days !== 0){
            $hours = $hours - (24 * $days);
            return $days.' days '.$hours.' hours';
        }elseif ($hours !== 0){
            $minutes = $minutes - (60 * $hours);
            return $hours.' hours '.$minutes.' min';
        }elseif ($minutes !== 0){
            return $minutes.' min';
        }else{
            return $seconds.' sec';
        }
    }

    public function clockedIn()
    {
        //check if entry exists
        if($this->newestEntry($this->currentUser())){
            return true;
        }

        return false;
    }

    public function currentUser(){

        if (Auth()->check()){
            $userId = Auth()->id();
        }else{
            $userId = $this->getUserFromCard(Input::get('card'));
        }

        return $userId;
    }

    /**
     * @return bool
     */
    public function getUserFromCard($card)
    {
        $card = Card::where('value', 'like', '%'.$card.'%')
            ->where('user_id', '!=', null)
            ->first();

        if($card !== null){
            return $card->user->id;
        }

        return 404;
    }

    /**
     * @return bool
     */
    public function getDeviceFromMacAddress($mac_address)
    {
        $device = Devices::where('mac_address', 'like', '%'.$mac_address.'%')
            ->first();

        if($device !== null){
            return $device->id;
        }

        return null;
    }

    public function newestEntry()
    {
        return $this->where('active', '=', 1)
            ->myRecords()
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function getClockedPosition($date)
    {
        $date = Carbon::parse($date);
        $endOfDay = Carbon::parse($date)->endOfDay();
        $startOfDay = Carbon::parse($date)->startOfDay();
        $dayInSeconds = 86400;
        $width = null;
        $worked_min = null;

        if ($this->active == 1){
            $worked_min = $this->started_at->diffInSeconds(Carbon::now());
        }else{
            $worked_min = $this->started_at->diffInSeconds($this->stopped_at);
        }

        if($this->active == 1)
        {
            if ($startOfDay->format('Y-m-d') <= Carbon::now()->format('Y-m-d')){
                if($this->started_at->format('Y-m-d') == $startOfDay->format('Y-m-d'))
                {
                    //started today
                    $diffTime = $this->started_at->diffInSeconds(Carbon::now())
                        -  Carbon::now()->diffInSeconds($endOfDay);
                    $leftStartPosition = number_format(($this->started_at->diffInSeconds($startOfDay) / $dayInSeconds)*100, 2);
                    $width = number_format(($diffTime * 100) / $dayInSeconds, 2);
                } elseif($this->started_at->format('Y-m-d') < $startOfDay->format('Y-m-d')
                    && Carbon::now()->format('Y-m-d') > $startOfDay->format('Y-m-d'))
                {
                    //started before yesterday
                    $diffTime = $dayInSeconds;
                    $leftStartPosition = 0;
                    $width = number_format(100, 2);
                } elseif($this->started_at->format('Y-m-d') < $startOfDay->format('Y-m-d')
                     && Carbon::now()->format('Y-m-d') == $startOfDay->format('Y-m-d'))
                {
                    //started yesterday
                    $diffTime = $this->started_at->diffInSeconds(Carbon::now())
                        - $this->started_at->diffInSeconds($startOfDay);
                    $leftStartPosition = 0;
                    $width = number_format(($diffTime * 100) / $dayInSeconds, 2);
                }
            }
        }elseif($this->started_at->format('d-m-Y') < $date
            && $this->stopped_at->format('d-m-Y') > $date)
        {
            //started before this day and ended after this day
            $diffTime = $dayInSeconds;
            $leftStartPosition = 0;
            $width = 100;
        }elseif ($this->stopped_at->format('d-m-Y') > $date
            && $this->started_at->format('d-m-Y') == $date)
        {
            //started this day worked boyond that day
            $diffTime = $this->started_at->diffInSeconds($endOfDay);
            $leftStartPosition = number_format(($this->started_at->diffInSeconds($startOfDay) / $dayInSeconds)*100, 2);
            $width = number_format(($diffTime * 100) / $dayInSeconds, 2);
        }elseif ($this->stopped_at->format('d-m-Y') == $date
            && $date < $this->started_at->format('d-m-Y'))
        {
            //started yesterday ended this day
            $diffTime = $this->stopped_at->diffInSeconds($startOfDay);
            $leftStartPosition = 0;
            $width = number_format(($diffTime * 100) / $dayInSeconds, 2);
        }elseif ($this->started_at->format('d-m-Y') == $date->format('d-m-Y')
            && $this->stopped_at->format('d-m-Y') < $date->format('d-m-Y'))
        {
            //started before this day ended this day
            $diffTime = $this->started_at->diffInSeconds($endOfDay);
            $width = number_format(($diffTime * 100) / $dayInSeconds, 2);
            $leftStartPosition = 100 - $width;
        }elseif($this->started_at->format('d-m-Y') == $this->stopped_at->format('d-m-Y'))
        {
            //started this day ended this day
            $diffTime = $this->started_at->diffInSeconds($this->stopped_at);
            $leftStartPosition = number_format(($this->started_at->diffInSeconds($startOfDay) / $dayInSeconds)*100, 2);
            $width = number_format(($diffTime * 100) / $dayInSeconds, 2);

        }elseif($this->stopped_at->format('d-m-Y') == $date->format('d-m-Y'))
        {
            //started before this day ended this day
            $diffTime = $this->stopped_at->diffInSeconds($startOfDay);
            $leftStartPosition = 0;
            $width = number_format(($diffTime * 100) / $dayInSeconds, 2);
        }

        if ($width != null){
            $times = (object) [
                'width' => $width,
                'user_id' => $this->user_id,
                'name' => $this->user->name,
                'leftStartPosition' => $leftStartPosition,
                'started' => $this->started_at->format('Y-m-d H:i'),
                'stopped' => $this->stopped_at == null ? Carbon::now()->format('Y-m-d H:i') : $this->stopped_at->format('Y-m-d H:i'),
                'worked_min' => (int)$worked_min / 60,
                'diff_time' => (int)number_format((int)$diffTime / 60, 0, '', ''),
            ];
            return $times;
        }
    }

    public function workedToDay($date, $user_id = null)
    {
        $clocks = $this
            ->whereBetween('started_at', [
                Carbon::parse($date->format('d-m-Y')),
                Carbon::parse($date->format('Y-m-d').'23:59:59')
            ])
            ->where(function ($q) use ($user_id){
                if ($user_id != null){
                    $q->where('user_id', '=', $user_id);
                }
            })
            ->orWhereBetween('stopped_at', [
                Carbon::parse($date->format('d-m-Y')),
                Carbon::parse($date->format('Y-m-d').'23:59:59')
            ])
            ->where(function ($q) use ($user_id){
                if ($user_id != null){
                    $q->where('user_id', '=', $user_id);
                }
            })
            ->orWhere(function ($q) use ($date){
                $q->where('started_at', '<', Carbon::parse($date->format('d-m-Y')));
                $q->where('stopped_at', '>', Carbon::parse($date->format('d-m-Y')));
            })
            ->where(function ($q) use ($user_id){
                if ($user_id != null){
                    $q->where('user_id', '=', $user_id);
                }
            })
            ->orWhere(function ($q) use ($date){
                $q->where('started_at', '<', Carbon::parse($date->format('d-m-Y')));
                $q->where('stopped_at', '=', null);
            })
            ->where(function ($q) use ($user_id){
                if ($user_id != null){
                    $q->where('user_id', '=', $user_id);
                }
            })
            ->orWhere(function ($q) use ($date){
                $q->where('started_at', '=', Carbon::parse($date->format('d-m-Y')));
                $q->where('stopped_at', '=', null);
            })
            ->where(function ($q) use ($user_id){
                if ($user_id != null){
                    $q->where('user_id', '=', $user_id);
                }
            })
            ->get()
         ;

        return $clocks;
    }

    public function diffInMin()
    {
        if ($this->active){
            return $this->time()->diffInMinutes($this->started_at);
        }else{
            return $this->stopped_at->diffInMinutes($this->started_at);
        }
    }

    public function timeToPercentage(){
        $position = ($this->timePosition($this->started_at->format('H:i')) * 100);

        return number_format($position / 1440, 2);
    }

    public function timeLength(){
        $position = ($this->worked_min * 100);

        $position = number_format(($position / 1440), 2);

        if ($position + $this->timeToPercentage() > 100){
            $position = 100 - $this->timeToPercentage();
        }
//        $position = $this->timeToPercentage();

        return $position;
    }

    private function timePosition($workingHours){
        $timeArray = explode(':', $workingHours);

        $hrs = (int)$timeArray[0];
        $min = (int)$timeArray[1];

        $totalMinutes = $hrs * 60;
        $totalMinutes = $totalMinutes + $min;

        return $totalMinutes;
    }


    public function scopeMyRecords($query)
    {
        $query->where('user_id', '=', $this->currentUser());
    }

    public function scopeThisMonth($query, $subMonth = 0)
    {
        $query->whereBetween('started_at', [
            Carbon::now()->startOfMonth()->subMonth($subMonth),
            Carbon::now()->endOfMonth()->subMonth($subMonth)
        ]);
    }

    public function scopeLatest($query, $column = null)
    {
        if (!$column) {
            $column = self::CREATED_AT;
        }

        return $query->orderBy($column, 'desc');
    }

    public function scopeOldest($query, $column = null)
    {
        if (!$column) {
            $column = self::CREATED_AT;
        }

        return $query->orderBy($column, 'asc');
    }

    public function scopeMyBusiness($query)
    {
        return $query->whereHas('user.business', function ($q){
            $q->where('id', '=', $this->getBusinessFromUser()->id);
        });
    }

    public function scopeMyLocation($query, $column = null)
    {
//        return $query->whereHas('user.business.locations', function ($q){
//            $q->where('id', '=', $this->getBusinessFromUser()->id);
//        });
    }
}
