<?php

namespace App\Http\Controllers\Panel;

use App\Calendar;
use App\Http\Requests\CalendarStoreRequest;
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
        $calendar = $this->calendar->get();

        $users = $this->user->get();

        $events = [];

        foreach ($calendar as $cal){
            $events[] = \Calendar::event(
                $cal->title, //event title
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
            ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
    //            'viewRender' => 'function() {alert("Callbacks!");}'
            ]);

        return view('calendar.index')
            ->with('calendar', $calendar)
            ->with('render', $render)//eventTitle
            ->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CalendarStoreRequest $request)
    {
        $calendar = $this->calendar;

        $calendar->user_id = $request->user;
        $calendar->title = $request->title;
        $calendar->description = $request->description;
        $calendar->full_day = $request->full_day == null ? 0:1;
        $calendar->private = $request->private == null ? 0:1;
        $calendar->start = $request->start;
        $calendar->stop = $request->stop;

        $calendar->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $calendar = $this->calendar->findOrFail($id);

        $users = $this->user->get();

        return view('calendar.edit')
            ->with('calendar', $calendar)
            ->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $calendar = $this->calendar->findOrFail($id);

        $users = $this->user->get();

        return view('calendar.edit')
            ->with('calendar', $calendar)
            ->with('users', $users);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CalendarStoreRequest $request, $id)
    {
        $calendar = $this->calendar->findOrFail($id);

        $calendar->user_id = $request->user;
        $calendar->title = $request->title;
        $calendar->description = $request->description;
        $calendar->full_day = $request->full_day;
        $calendar->private = $request->private;
        $calendar->start = $request->start;
        $calendar->stop = $request->stop;

        $calendar->save();

        return redirect()->route('calendar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $calendar = $this->calendar->findOrFail($id);
        $calendar->delete();
        return redirect()->route('calendar.index');
    }
}
