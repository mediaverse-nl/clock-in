<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendar';

    protected $primaryKey = "id";


    protected $dates = [
        'start',
        'stop',
        'created_at',
        'updated_at'
    ];

    protected $dateFormat = 'Y-m-d H:i:s';

    public $incrementing = true;

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeWhereTitle($q, $title){
        if ($title !== null){
            return $q->where('title', '=', $title);
        }
    }

    public function scopeWhereUser($q, $user_id){
        if ($user_id !== null){
            return $q->where('user_id', '=', $user_id);
        }
    }

    public function workedFrom()
    {
        if($this->title == 'werk'){
            return $this->user->clocked()
//                ->whereDay('started_at', '=', $this->start->format('Y-m-d'))
                ->whereDate('started_at', '=', $this->start->format('Y-m-d'))

                //                ->sortBy('started_at')
                ->get();
        }
    }

    public function workedTo()
    {
        if($this->title == 'werk'){
//            dd($this->stop->format('Y-m-d'));
            return $this
                ->user
                ->clocked()
                ->whereDate('stopped_at', '=', '2018-06-30')
//                ->sortByDesc('stopped_at')
//                ->orderBy('stopped_at')
                ->first();
        }
    }


    public function textColor($color = '#fff')
    {
//        if($this->title == 'werk'){
//            $color = '#444';
//        }elseif ($this->title == 'vrij'){
//            $color = '#444';
//        }elseif ($this->title == 'feestdag'){
//            $color = '#444';
//        }elseif ($this->title == 'vakantie'){
//            $color = '#444';
//        }elseif ($this->title == 'afspraak'){
//            $color = '#444';
//        }

        return $color;
    }

    public function backgroundColor($color = '#333')
    {
        if($this->title == 'werk'){
            $color = '#5CFF36';
        }elseif ($this->title == 'vrij'){
            $color = '#BEBF31';
        }elseif ($this->title == 'feestdag'){
            $color = '#1A7F34';
        }elseif ($this->title == 'vakantie'){
            $color = '#3E86E5';
        }elseif ($this->title == 'afspraak'){
            $color = '#DD7F2A';
        }

        return $color;
    }

    public function privateEvent()
    {
        if($this->user_id){
            return true;
        }
        return false;
    }

    public static function eventTitle()
    {
        return collect([
            'werk' =>       'werk',
            'vrij' =>       'vrij',
            'feestdag' =>   'feestdag',
            'vakantie' =>   'vakantie',
            'afspraak' =>   'afspraak',
            'standaard' =>  'standaard',
        ]);
    }

}
