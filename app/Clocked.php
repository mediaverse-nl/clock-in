<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Clocked extends Model
{
    protected $table = 'clocked';

    /**
     * Get the user that owns the phone.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function clockedIn()
    {
        //check if entry exists
        if($this->newestEntry($this->currentUser())){
            return true;
        }

        return false;
    }

    public function currentUser(){

        if (Auth()->check()){
            $userId = Auth()->id();
        }else{
            $userId = $this->getUserFromCard(Input::get('card'));
        }

        return $userId;
    }

    /**
     * @return bool
     */
    public function getUserFromCard($card)
    {
        $card = Card::where('value', 'like', '%'.$card.'%')->first();

        if($card !== null){
            return $card->user->id;
        }

        return 404;
    }

    public function newestEntry()
    {
        return $this->where('active', '=', 1)
            ->myRecords()
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function scopeMyRecords($query)
    {
        $query->where('user_id', '=', $this->currentUser());
    }

    public function scopeThisMonth($query, $subMonth = 0)
    {
        $query->whereBetween('started_at', [
            Carbon::now()->startOfMonth()->subMonth($subMonth),
            Carbon::now()->endOfMonth()->subMonth($subMonth)
        ]);
    }
}
