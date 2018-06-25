<?php

namespace App\Http\Controllers\Panel;

use App\Calendar;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    protected $calendar;
    protected $user;

    public function __construct(Calendar $calendar, User $user)
    {
        $this->calendar = $calendar;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $calendar = $this->calendar->get();

        $users = $this->user->get();
        $events = [];

        $events[] = \Calendar::event(
            'Event One', //event title
            false, //full day event?
            Carbon::now(), //start time (you can also use Carbon instead of DateTime)
            Carbon::now(), //end time (you can also use Carbon instead of DateTime)
            0 //optionally, you can specify an event ID
        );

//        $events[] = Calendar::event(
//            "Valentine's Day", //event title
//            true, //full day event?
//            new \DateTime('2015-02-14'), //start time (you can also use Carbon instead of DateTime)
//            new \DateTime('2015-02-14'), //end time (you can also use Carbon instead of DateTime)
//            'stringEventId' //optionally, you can specify an event ID
//        );

//        $eloquentEvent = EventModel::first(); //EventModel implements MaddHatter\LaravelFullcalendar\Event

        $calendar = \Calendar::addEvents($events) //add an array with addEvents
            ->setOptions([ //set fullcalendar options
                'firstDay' => 1
            ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
    //            'viewRender' => 'function() {alert("Callbacks!");}'
            ]);

        return view('calendar.index')
            ->with('calendar', $calendar)
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
