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

        $users = $business->users;

        $clocks = [];
        $baseClocks = [];

        foreach ($users as $user) {
            $baseClocks[] = $user->clocked()->get();
            $clocks[] = $user->clocked()
                ->where(function ($q){
                    if($this->hasSession('user')){
                        $q->where('user_id', '=', $this->getSessionKey('user'));
                    }
                    if($this->hasSession('date')){
                        $q->whereBetween('created_at', [Carbon::now(), Carbon::now()->addDays(7)]);
                    }
                })
                ->whereHas('device', function ($q){
                    if($this->hasSession('location')){
                        $q->where('location_id', '=', $this->getSessionKey('location'));
                    }
                })
                ->get();
        }

        $setDate = \App\Calendar::startOfWeek()->format('d-m-Y').' - '.\App\Calendar::endOfWeek()->format('d-m-Y');

        $minDate = collect($baseClocks)->collapse()->sortBy('created_at')->first()->created_at;

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
            ->with('minDate', $minDate)
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
        //
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
