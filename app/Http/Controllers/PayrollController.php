<?php

namespace App\Http\Controllers;

use App\Clocked;
use App\EventModel;
use Calendar;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayrollController extends Controller
{
    protected $clocked;

    public function __construct(Clocked $clocked)
    {
        $this->clocked = $clocked;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = [];

//        return \Auth::user();

        $clocked = \Auth::user()
            ->clocked()
            ->where('active','=', '0')
            ->get();

        foreach ($clocked as $clock){
            $events[] = \Calendar::event(
                'clocked in', //event title
                false, //full day event?
                $clock->started_at, //start time (you can also use Carbon instead of DateTime)
                $clock->stopped_at, //end time (you can also use Carbon instead of DateTime)
                $clock->id, //optionally, you can specify an event ID
                [
                    'url' => route('payroll.show', $clock->id),
                    //any other full-calendar supported parameters
                ]
            );
        }

        $calendar = \Calendar::addEvents($events) //add an array with addEvents
        ->setOptions([ //set fullcalendar options
            'firstDay' => 1
        ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
//            'viewRender' => ''
        ]);

        return view('payroll.index')->with('clocked', $clocked)->with('calendar', $calendar);
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
