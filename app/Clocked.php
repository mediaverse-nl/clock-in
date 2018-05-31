<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

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
//        dd($this->where('active', '=', 1)
//            ->where('user_id', '=', $this->currentUser())
//            ->orderBy('created_at', 'desc')
//            ->first());

        return $this->where('active', '=', 1)
            ->where('user_id', '=', $this->currentUser())
            ->orderBy('created_at', 'desc')
            ->first();
    }
}
