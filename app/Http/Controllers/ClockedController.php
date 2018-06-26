<?php

namespace App\Http\Controllers;

use App\Card;
use App\Clocked;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Input;

class ClockedController extends Controller
{
    protected $clocked;
    protected $card;
    protected $timeNow;

    public function __construct(Clocked $clocked, Card $card)
    {
        $this->clocked = $clocked;
        $this->card = $card;
        $this->timeNow = Carbon::now();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $card_id = $request->get('card');
        $check = $this->clocked->getUserFromCard($card_id);

        if($check != 404){
            $isClockedIn = $this->clocked->clockedIn();

            if ($isClockedIn){
                $this->updateEntry($request);

                return 200;
            }else{
                $this->storeEntry($request);

                return 201;
            }
        }

        $thisCard = $this->card->where('value', '=', $card_id);

        if ($thisCard->count() == 0){
            $card = $this->card;
            $card->value = $card_id;
            $card->save();
        }elseif ($thisCard->where('user_id', '=', null)->exists()){
            $card = $this->card->where('value', '=', $card_id)->first();
            $card->delete();

            $card = $this->card;
            $card->value = $card_id;
            $card->save();
        }

        return 404;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clocked = $this->clocked;
        $clocked->started_at = $this->timeNow->toDateTimeString();
        $clocked->user_id = $this->clocked->currentUser() ;
        $clocked->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateEntry(Request $request)
    {
        $entry = $this->clocked->newestEntry();

        $diffInMinutes = $this->timeNow->diffInMinutes($entry->started_at);

        $entry->stopped_at = $this->timeNow->toDateTimeString();
        $entry->worked_min = $diffInMinutes;
        $entry->active = 0;
        $entry->save();

        return $diffInMinutes;
    }
}
