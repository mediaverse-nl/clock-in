<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function day()
    {
        $users = $this->user->get();

        return view('admin.schedule.day')
            ->with('users', $users);
    }

    public function week()
    {
        return view('admin.schedule.week');
    }

    public function month()
    {
        return view('admin.schedule.month');
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
