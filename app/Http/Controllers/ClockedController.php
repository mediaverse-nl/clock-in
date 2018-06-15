<?php

namespace App\Http\Controllers;

use App\Clocked;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Input;

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
        $card = $request->get('card');
//        2F B3 7E 02
        $check = $this->clocked->getUserFromCard($card);
//        return 'asdas'. Input::get('card'). 'sdasd';

        if($check != 404){
            $isClockedIn = $this->clocked->clockedIn();

//            return dd($isClockedIn);
            if ($isClockedIn){
//                return 'true';
                $workedTime = $this->update($request);

                $inHours = number_format($workedTime / 60);

                $leftMin = $workedTime - ($inHours * 60);

                if ($leftMin < 60){
                    $workedMin = $leftMin;
                }else{
                    $workedMin = 0;
                }

                return 'h'. $inHours.'min'.$workedMin;
            }else{
                $this->store($request);

                return 201;
            }
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
