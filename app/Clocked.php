<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use MongoDB\Driver\Query;

class Clocked extends Model
{
    protected $table = 'clocked';

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
            $userId = Input::get('user_id');
        }

        return $userId;
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

    public function scopeThisMonth($query, $subMonth = 2)
    {
        $query->whereBetween('started_at', [
            Carbon::now()->startOfMonth()->subMonth($subMonth),
            Carbon::now()->endOfMonth()->subMonth($subMonth)
        ]);
    }
}
