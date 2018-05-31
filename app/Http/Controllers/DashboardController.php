<?php

namespace App\Http\Controllers;

use App\Clocked;

class DashboardController extends Controller
{
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
        $checked = $this->clocked->thisMonth()->myRecords();

        return view('dashboard')->with('checked', $checked);
    }
}
