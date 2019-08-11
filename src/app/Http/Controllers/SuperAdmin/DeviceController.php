<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Devices;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeviceController extends Controller
{
    protected $device;
    protected $location;

    public function __construct(Devices $device, Location $location)
    {
        $this->location = $location;
        $this->device = $device;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $devices = $this->device->get();

        return view('super-admin.devices.index')
            ->with('devices', $devices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($location_id)
    {
        $devices = $this->device
            ->where('location_id', '=', null)
            ->get();

        return view('admin.device.create')
            ->with('devices', $devices)
            ->with('location_id', $location_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $device = $this->device;

        $device->location_id = $request->location_id;
//        $device->location_id = $request->device;

        return ;
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
