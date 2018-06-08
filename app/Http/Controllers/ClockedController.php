<?php

namespace App\Http\Controllers;

use App\Clocked;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ClockedController extends Controller
{
    protected $clocked;
    protected $timeNow;

    public function __construct(Clocked $clocked)
    {
        $this->clocked = $clocked;
        $this->timeNow = Carbon::now();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view()->with();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
//        2F B3 7E 02
        $check = User::where('id', '=', Input::get('user_id'))->exists();

        if($check){
            $isClockedIn = $this->clocked->clockedIn();

            if ($isClockedIn){
                $workedTime = $this->update($request);

                $inHours = number_format($workedTime / 60);

                $leftMin = $workedTime - ($inHours * 60);

                if ($leftMin < 60){
                    $workedMin = $leftMin;
                }else{
                    $workedMin = 0;
                }

                return 'clocked out, u worked for hours '. $inHours.' min '.$workedMin;
            }

            $this->store($request);

            return 'clocked in';
        }else{
            return 'do not exist';
        }
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
    public function update(Request $request)
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
