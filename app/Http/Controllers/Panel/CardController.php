<?php

namespace App\Http\Controllers\Panel;

use App\Card;
use App\Http\Requests\CardUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    protected $card;
    protected $user;

    public function __construct(Card $card, User $user)
    {
        $this->card = $card;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = $this->card->get();

        return view('card.index')->with('cards', $cards);
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
        $card = $this->card->findOrFail($id);

        return view('card.show')->with('card', $card);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = $this->card->findOrFail($id);
        $user = $this->user->get();

        return view('card.edit')
            ->with('user', $user)
            ->with('card', $card);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CardUpdateRequest $request, $id = null)
    {
        if (empty($id)){
            $card = $this->card->findOrFail($request->id);
        }else{
            $card = $this->card->findOrFail($id);
        }

        $card->user_id = $request->user_id;
        $card->save();

        if (empty($id)){
            redirect()->back();
        }

        return redirect()->route('card.index');
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
