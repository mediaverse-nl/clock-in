<?php

namespace App\Http\Controllers\Panel;

use App\Calendar;
use App\Card;
use App\Clocked;

use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $clocked;
    protected $card;
    protected $user;
    protected $calendar;

    public function __construct(Clocked $clocked, Card $card, Calendar $calendar, User $user)
    {
        $this->clocked = $clocked;
        $this->card = $card;
        $this->user = $user;
        $this->calendar = $calendar;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now = Carbon::now();
        $checked = $this->clocked->thisMonth()->myRecords();

        $clocked = $this->clocked->where('active','=',1)->count();
        $users = $this->user->get();
        $calendar = $this->calendar->get();
        $calendarEvents = $this->calendar
            ->whereBetween('start', [
                Carbon::now()->startOfDay(),
                Carbon::now()->endOfDay()
            ])->count();

        return view('dashboard')
            ->with('users', $users)
            ->with('clocked', $clocked)
            ->with('calendarEvents', $calendarEvents)
            ->with('calendar', $calendar)
            ->with('checked', $checked);
    }

    public function show()
    {
        $user = Auth::user();

        $cards = $this->card
            ->where('user_id', '=', null)
            ->get();

        $calendar = $this->calendar
            ->where('user_id', '=', $user->id)
            ->where('private', '=',0)
            ->orWhere('title', '=','werk')
            ->get();

        $clocked = $user
            ->clocked()
            ->get();

        $workedMin = $user
            ->clocked()
            ->where('active', '=', 0)
            ->sum('worked_min');

        $hours = number_format(floor($workedMin / 60), 0);
        $min = number_format( $workedMin - $hours * 60  );
        $worked_time = 'h'.$hours.' m'.$min;

        $events = [];

        $cards = $this->card
            ->where('user_id', '=', null)
            ->get();

        foreach ($calendar as $cal){
            $events[] = \Calendar::event(
                '- '.($cal->user_id ? $cal->user->name: '') , //event title
//                '- '.$cal->title . ''.($cal->user_id ? $cal->user->name: '') , //event title
                $cal->full_day, //full day event?
                $cal->start, //start time (you can also use Carbon instead of DateTime)
                $cal->stop, //end time (you can also use Carbon instead of DateTime)
                $cal->id, //optionally, you can specify an event ID
                [
                    'url' => route('calendar.edit', $cal->id),
                    'textColor' => $cal->textColor(), //'#0A0A0A'
                    'color' => $cal->backgroundColor(), //'#444444'
                ]
            );
        }
        foreach ($clocked as $clock){
            $events[] = \Calendar::event(
                '- in', //event title
                false, //full day event?
                $clock->start, //start time (you can also use Carbon instead of DateTime)
                $clock->stop, //end time (you can also use Carbon instead of DateTime)
                $clock->id, //optionally, you can specify an event ID
                [
                    'url' => route('clocked.edit', $clock->id),
                    'textColor' => '#fff', //'#0A0A0A'
                    'color' => '#0A0A0A', //''
                ]
            );
        }

        $render = \Calendar::addEvents($events) //add an array with addEvents
            ->setOptions([ //set fullcalendar options
                'FirstDay' => 1,
                'contentheight' => 850,
                'editable' => false,
                'allDay' => false,
                'aspectRatio' => 1.5,
                'slotLabelFormat' => 'HH:mm:ss',
                'timeFormat' => 'HH:mm',
                'color' => '#73e600',
            ])->setCallbacks([]);

        return view('auth.show')
            ->with('cards', $cards)
            ->with('worked', $worked_time)
            ->with('render', $render)
            ->with('user', $user);
    }
}
