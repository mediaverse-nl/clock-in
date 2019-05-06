<?php

namespace App\Traits;

use App\Card;
use App\Clocked;
use App\Location;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

trait getLocationTrait
{
//    public $location;


    public function currentLocationId()
    {
        return $location_id = key($this->getLocationsFromUser());

//        $session = session('location_id');

//        if (Session::has('location_id')){
//            $session = Session::get('location_id');
//        }else{
//            $session = Session::put('location_id', $location_id);
//        }
//        Session::save();

//        dd($session);

//        return $session;
    }

    public function getUser()
    {
        return auth()->user();
    }

    public function getBusinessFromUser()
    {
        return auth()->user()->business;
    }

    public function getLocationIds()
    {
//        return auth()->user()
//            ->business
//            ->locations
//            ->pluck('id')
//            ->toArray();
    }

    public function getLocationsFromUser()
    {
        $user = auth()->user();

        return $user->business->locations->pluck('fulAddress', 'id')->toArray();
    }

    public function getDevicesFromLocation()
    {

    }



}