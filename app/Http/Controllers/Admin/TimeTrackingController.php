<?php

namespace App\Http\Controllers\Admin;

use App\Clocked;
use App\Traits\getLocationTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeTrackingController extends Controller
{
    use getLocationTrait;

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
        $clocked = $this->clocked
            ->where('device_id', '=', 1)
//            ->where('location_id', '=', 1)
                ->orderBy('active', 'desc')
                ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.timeTracking.index')
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
