<?php

namespace App\Http\Controllers\Panel;

use App\Calendar;
use App\Http\Requests\CalendarStoreRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Input;

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
        $category = Input::get('category');
        $user_id = Input::get('user');

        $calendar = $this->calendar->whereTitle($category)->whereUser($user_id)->get();

        $users = $this->user->get();

        $events = array_merge(
            $this->calendar->calendarEvents($calendar)
        );

        $render = $this->calendar->renderCalendar($events);

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
        $carbon = new Carbon();

        $calendar = $this->calendar;

        $calendar->user_id = $request->user;
        $calendar->title = $request->title;
        $calendar->description = $request->description;
        $calendar->full_day = $request->full_day == null ? 0:1;
        $calendar->private = $request->private == null ? 0:1;
        $calendar->start = $carbon->parse($request->start);
        $calendar->stop = $carbon->parse($request->stop);

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

        return view('calendar.show')
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
        $carbon = new Carbon();

        $calendar = $this->calendar->findOrFail($id);

        $calendar->user_id = $request->user;
        $calendar->title = $request->title;
        $calendar->description = $request->description;
        $calendar->full_day = $request->full_day == null ? 0:1;
        $calendar->private = $request->private == null ? 0:1;
        $calendar->start = $carbon->parse($request->start);
        $calendar->stop = $carbon->parse($request->stop);

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
