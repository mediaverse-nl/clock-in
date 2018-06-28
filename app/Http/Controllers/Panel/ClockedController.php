<?php

namespace App\Http\Controllers\Panel;

use App\Card;
use App\Clocked;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClockedController extends Controller
{
    protected $clocked;
    protected $card;
    protected $timeNow;

    public function __construct(Clocked $clocked, Card $card)
    {
        $this->clocked = $clocked;
        $this->card = $card;
        $this->timeNow = Carbon::now();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clocks = $this->clocked->get();

        return view('clocked.index')->with('clocks', $clocks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
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
        $clocekd = $this->clocked->findOrFail($id);

        return view('clocked.edit')->with('clocked', $clocekd);
    }

    public function update(Request $request, $id)
    {
        $entry = $this->clocked->findOrFail($id);

        $entry->started_at = $request->started_at;
        $entry->stopped_at = $request->stopped_at;
        $entry->worked_min = Carbon::parse($request->stopped_at)->diffInMinutes($request->started_at);

        $entry->save();

        return redirect()->route('user.edit', $entry->user_id);
    }

    public function stopTimer($id)
    {
        $entry = $this->clocked->findOrFail($id);
        $entry->stopped_at = $this->timeNow->toDateTimeString();
        $entry->worked_min = Carbon::parse($entry->stopped_at)->diffInMinutes($entry->started_at);
        $entry->active = 0;
        $entry->save();

        return redirect()->route('user.edit', $entry->user_id);
    }

    public function startTimer(Request $request)
    {
        $entry = $this->clocked;

        $entry->active = 1;
        $entry->user_id = $request->user_id;

        $entry->save();

        return redirect()->route('user.edit', $entry->user_id);
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
