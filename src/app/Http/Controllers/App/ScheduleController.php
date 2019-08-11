<?php

namespace App\Http\Controllers\App;

use App\Calendar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    protected $calendar;

    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = [];

        $events[] = \Calendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            new \DateTime('2018-12-24'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2018-12-24'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );

        $events[] = \Calendar::event(
            "Valentine's Day", //event title
            true, //full day event?
            new \DateTime('2018-12-24'), //start time (you can also use Carbon instead of DateTime)
            new \DateTime('2018-12-24'), //end time (you can also use Carbon instead of DateTime)
            'stringEventId' //optionally, you can specify an event ID
        );

        $render = $this->calendar->renderCalendar($events);

        return view('app.schedule.index')
            ->with('render', $render);
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
