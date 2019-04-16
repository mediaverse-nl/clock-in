<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Clocked extends Model
{
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
}
