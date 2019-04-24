<?php

namespace App\Traits;

use App\Card;
use App\Clocked;
use App\Location;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

trait getLocationTrait
{
    public $location;

    public function __construct($location)
    {
//        $this->location = $location;
    }

    public function currentLocationId()
    {
        $location_id = key($this->getLocationsFromUser());

        $session = session('location_id');

        if (!isset($session)){
            $session = session('location_id', $location_id);
        }else{
            $session = session('location_id');
        }

        return $session;
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