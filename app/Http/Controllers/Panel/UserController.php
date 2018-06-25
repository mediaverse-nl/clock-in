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

        return view('users.show')->with('user', $user);
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
        $cards = $this->card
            ->where('user_id', '=', null)
            ->get();

        return view('users.edit')
            ->with('cards', $cards)
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
