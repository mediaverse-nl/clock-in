<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function __construct()
    {

    }

    public function day()
    {
        return view('admin.schedule.day');
    }

    public function week()
    {
        return view('admin.schedule.week');
    }

    public function month()
    {

    }

    public function availability()
    {
        return view('admin.schedule.availability');
    }

    public function departments()
    {
        return view('admin.schedule.departments');
    }

}
