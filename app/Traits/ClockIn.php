<?php

namespace App\Traits;

use App\Card;
use App\Clocked;
use Carbon\Carbon;
use Illuminate\Http\Request;

trait ClockIn
{
    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return int
     */
    public function check(Request $request, $rfidTag)
    {
        $card_id = $request->get($rfidTag);
        $check = $this->clocked()->getUserFromCard($card_id);

        if($check != 404){
            $isClockedIn = $this->clocked()->clockedIn();

            if ($isClockedIn){
                $this->updateEntry($request);
                return 200;
            }else{
                $this->storeEntry($request);
                return 201;
            }
        }

        $thisCard = $this->card()->where('value', '=', $card_id);

        if ($thisCard->count() == 0){
            $card = $this->card();
            $card->value = $card_id;
            $card->save();
        }elseif ($thisCard->where('user_id', '=', null)->exists()){
            $card = $this->card()->where('value', '=', $card_id)->first();
            $card->delete();

            $card = $this->card();
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
    private function storeEntry(Request $request)
    {
        $clocked = $this->clocked();

        $clocked->device_id = $this->clocked()->getDeviceFromMacAddress($request->mac_address);
        $clocked->started_at = $this->time()->toDateTimeString();
        $clocked->user_id = $this->clocked()->currentUser() ;
        $clocked->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    private function updateEntry(Request $request)
    {
        $entry = $this->clocked()->newestEntry();

        $diffInMinutes = $this->time()->diffInMinutes($entry->started_at);

        $entry->stopped_at = $this->time()->toDateTimeString();
        $entry->worked_min = $diffInMinutes;
        $entry->active = 0;
        $entry->save();

        return $diffInMinutes;
    }

    private function time(){
        return Carbon::now();
    }

    private function clocked(){
        return new Clocked();
    }

    private function card(){
        return new Card();
    }
}