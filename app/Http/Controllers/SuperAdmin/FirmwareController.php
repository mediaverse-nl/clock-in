<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Firmware;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FirmwareController extends Controller
{
    protected $firmware;

    public function __construct(Firmware $firmware)
    {
        $this->firmware = $firmware;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $firmware = $this->firmware->get();

        return view('super-admin.firmware.index')
            ->with('firmware', $firmware);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('super-admin.firmware.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $path = $request->path->storeAs('public/firmware', str_random(8).'.bin');

        $firmware = $this->firmware;
        $firmware->app_name = $request->app_name;
        $firmware->app_version = $request->app_version;
        $firmware->original_name = $request->path->getClientOriginalName();;
        $firmware->path = $path;
        $firmware->description = $request->description;
        $firmware->save();

        return redirect()->route('super.firmware.index');
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
