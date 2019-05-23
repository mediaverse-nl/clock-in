<?php

namespace App\Http\Controllers\Admin;

use App\Clocked;
use App\Traits\FilterSessionTrait;
use App\Traits\getLocationTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeTrackingController extends Controller
{
    use getLocationTrait, FilterSessionTrait;

    protected $clocked;

    public function __construct(Clocked $clocked)
    {
        $this->clocked = $clocked;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $business = $this->getBusinessFromUser();

        $users = $business
            ->load('users.clocked')
            ->users;

        $clocks = [];
        $baseClocks = [];

        foreach ($users as $user) {
            $baseClocks[] = $user
                ->load('clocked.device.location')
                ->clocked()
                ->get();

            $clocks[] = $user
                ->load('clocked.device.location')
                ->clocked()
                ->where(function ($q){
                    if($this->hasSession('user')){
                        $q->where('user_id', '=', $this->getSessionKey('user'));
                    }
                })
                ->where(function ($q){
                    if($this->hasSession('date')){
                        if($this->hasSession('date')){
                            $dateArray = explode(' - ', $this->getSessionKey('date'));
                            $q->whereDate('created_at', '>=', Carbon::parse($dateArray[0]));
                            $q->whereDate('created_at', '<=', Carbon::parse($dateArray[1].'23:59:59'));
                        }
                    }
                })
                ->whereHas('device', function ($q){
                    if($this->hasSession('location')){
                        $q->where('location_id', '=', $this->getSessionKey('location'));
                    }
                })
//                ->where('active', '=', 0)
//                ->orWhere('active', '=', 1)
//                ->groupBy('id')
                ->get();
        }

        $startDate = collect($baseClocks)->collapse()->sortBy('started_at')->first()->started_at->format('d-m-Y');
        $endDate = collect($baseClocks)->collapse()->sortByDesc('started_at')->first()->started_at->format('d-m-Y');

        $minDate = Carbon::parse($startDate)->format('d-m-Y');
        $maxDate = Carbon::now()->format('d-m-Y');

        if ($startDate <= $minDate){
            $minDate = $startDate;
        }

        if($this->hasSession('date')){
            $dateArray = explode(' - ', $this->getSessionKey('date'));

            $startDate = $dateArray[0];
            $endDate = $dateArray[1];

            if ((bool)strtotime($dateArray[0]) || (bool)strtotime($dateArray[1])){
                $this->setItem('date', $startDate.' - '.$endDate);
            }

            $setDate = $this->getSessionKey('date');
        }else{
            $setDate = $minDate.' - '.$maxDate;
        }

        $locations = $business->locations->pluck('fulAddress', 'id');
        $users = $users->pluck('name', 'id');

        $location = $this->sessionExists('location');
        $user = $this->sessionExists('user');
        $date = $this->sessionExists('date');

        $clocked = collect($clocks)
            ->collapse()
             ->sortByDesc('active')
            ->sortByDesc('created_at');

        return view('admin.timeTracking.index')
            ->with('locations', $locations)
            ->with('location', $location)
            ->with('users', $users)
            ->with('user', $user)
            ->with('date', $date)
            ->with('startDate', $startDate)
            ->with('endDate', $endDate)
            ->with('minDate', $minDate)
            ->with('maxDate', $maxDate)
            ->with('setDate', $setDate)
            ->with('clocked', $clocked);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
