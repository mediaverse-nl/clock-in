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
