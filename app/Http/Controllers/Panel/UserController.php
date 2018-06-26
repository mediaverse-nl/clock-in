<?php

namespace App\Http\Controllers\Panel;

use App\Card;
use App\Http\Requests\UserCreateRequest;
use App\Mail\RegisterdAccount;
use App\User;
use Illuminate\Http\Request;

use  App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    protected $user;
    protected $card;

    public function __construct(User $user, Card $card)
    {
        $this->user = $user;
        $this->card = $card;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->get();

        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $random_password = str_random(8);

        $user = $this->user;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($random_password);

        $user->save();

        Mail::to($user->email)->send(new RegisterdAccount($user, $random_password));

        return redirect()
            ->route('user.index')
            ->with('success', 'Email has been sent to the user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        $calendar = $user->calendar;

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

        return view('users.show')
            ->with('calendar', $calendar)
            ->with('render', $render)//eventTitle
            ->with('user', $user);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->user->findOrFail($id);

        $calendar = $user->calendar()->get();
        $clocked = $user->clocked()->get();

        $events = [];

        $cards = $this->card
            ->where('user_id', '=', null)
            ->get();

        foreach ($calendar as $cal){
            $events[] = \Calendar::event(
                '- '.$cal->title, //event title
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
            ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
                //            'viewRender' => 'function() {alert("Callbacks!");}'
            ]);

        return view('users.edit')
            ->with('cards', $cards)
            ->with('render', $render)//eventTitle
            ->with('user', $user);
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
