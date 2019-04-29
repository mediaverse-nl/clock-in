<?php

namespace App\Http\Controllers\Admin;

use App\Clocked;
use App\Traits\FilterSessionTrait;
use App\Traits\getLocationTrait;
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
//        $this->filterItems(['user', 'date', 'location']);

//        $this->setItem('user', 1);

        $users = $this->getBusinessFromUser()->users;

        $clocks = [];
        foreach ($users as $user)
        {
            $clocks[] = $user->clocked()
                ->where(function ($q){
//                    $q->where('user_id', '=', 4);
                })
                ->get();
        }

        $clocked = collect($clocks)
            ->collapse()
            ->sortByDesc('active')
            ->sortByDesc('created_at');

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
