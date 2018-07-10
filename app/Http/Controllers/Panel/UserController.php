<?php

namespace App\Http\Controllers\Panel;

use App\Calendar;
use App\Card;
use App\Http\Requests\UserCreateRequest;
use App\Mail\RegisterdAccount;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    protected $user;
    protected $card;
    protected $role;
    protected $calendar;

    public function __construct(User $user, Card $card, Calendar $calendar, Role $role)
    {
        $this->user = $user;
        $this->card = $card;
        $this->role = $role;
        $this->calendar = $calendar;
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
        $roles = $this->role->get();
        $role = $user->userRoles()->get();
        $cards = $this->card->where('user_id', '=', null)->get();
        $worked_time = $user->workingTime();

        $events = array_merge(
            $this->calendar->calendarEvents($calendar),
            $this->calendar->calendarClocked($clocked)
        );

        $render = $this->calendar->renderCalendar($events);

        return view('users.edit')
            ->with('worked', $worked_time)
            ->with('cards', $cards)
            ->with('role', $role)
            ->with('roles', $roles)
            ->with('calendar', $calendar)
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
        $user = $this->user->findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        if (!empty($request->roles))
        {
            $user->userRoles()->delete();

            foreach ($request->roles as $role){
                $user->userRoles()->insert(['user_id' => $id, 'role_id' => $role]);
            }
        }

        return redirect()
            ->route('user.edit', $id);
    }

}
