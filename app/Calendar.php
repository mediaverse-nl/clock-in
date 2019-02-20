<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function calendarClocked($clocked)
    {
        $events = [];

        if(!empty($clocked)){
            foreach ($clocked as $clock){
                $events[] = \Calendar::event(
                    '- '. Carbon::parse($clock->stopped_at)->format('H:i'), //event title
                    false, //full day event?
                    Carbon::parse($clock->started_at), //start time (you can also use Carbon instead of DateTime)
                    Carbon::parse($clock->stopped_at),  //end time (you can also use Carbon instead of DateTime)
                    null, //optionally, you can specify an event ID
                    [
                        'url' => route('clocked.edit', $clock->id),
                        'textColor' => '#fff', //''
                        'color' => '#444444', //''
                    ]
                );
            }
        }
        return $events;
    }

    public function calendarEvents($calendar)
    {
        $events = [];

        if(!empty($calendar)){
            foreach ($calendar as $cal){
                $events[] = \Calendar::event(
                    '- '.$cal->title, //event title
                    $cal->full_day, //full day event?
                    Carbon::parse($cal->start), //start time (you can also use Carbon instead of DateTime)
                    Carbon::parse($cal->stop), //end time (you can also use Carbon instead of DateTime)
                    $cal->id, //optionally, you can specify an event ID
                    [
                        'url' => route('calendar.edit', $cal->id),
                        'textColor' => $cal->textColor(), //'#0A0A0A'
                        'color' => $cal->backgroundColor(), //'#444444'
                    ]
                );
            }
        }
        return $events;
    }

    public function renderCalendar($events){

        return \Calendar::addEvents($events) //add an array with addEvents
            ->setOptions([ //set fullcalendar options
                'FirstDay' => 1,
                'contentheight' => 850,
//                'themeSystem' => 'bootstrap3',
//                'theme' => 'bootstrap4',
//                'theme' => 'bootstrap3',
                'editable' => false,
                'allDay' => false,
                'aspectRatio' => 1.7,
                'slotLabelFormat' => 'HH:mm:ss',
                'timeFormat' => 'HH:mm',
                'defaultView' => 'basicWeek',
                'color' => '#73e600',
//                'defaultView' => 'listYear',
                 'header' => [
                    'left' => 'prev,next,today,list',
                    'center' => 'title',
                    'right' => 'month,agendaWeek,agendaDay basicWeek,basicDay',
                ],
//                'buttonText' => [
//                    'today' => 'Today',
//                    'month' => 'Calendar View',
//                    'listYear' => 'List View',
//                ],
            ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
                //'viewRender' => 'function() {alert("Callbacks!");}'
            ]);
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
            'verlof' =>     'verlof',
            'ziek' =>       'ziek',
        ]);
    }

}
