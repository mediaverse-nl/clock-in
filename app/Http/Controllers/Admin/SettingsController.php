<?php

namespace App\Http\Controllers\Admin;

use App\Location;
use App\Traits\getLocationTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    use getLocationTrait;

    protected $location;
    protected $business;

    public function __construct(Location $location)
    {
        $this->location = $location;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businessFromUser = $this->getBusinessFromUser();
        $business = $businessFromUser->get();

        $locations = $businessFromUser->locations;

        return view('admin.settings.index')
            ->with('business', $business)
            ->with('locations', $locations);
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
}
