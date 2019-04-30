<?php

namespace App\Http\Controllers\Admin;

use App\Traits\getLocationTrait;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{

//    use getLocationTrait{
//        getLocationTrait::__construct as private __getLocationTraitConstruct;
//    }

    protected $user;

    public function __construct(User $user)
    {
//        $this->__getLocationTraitConstruct();
//        parent::__construct();

        $this->user = $user;
    }

    public function day()
    {
        $users = $this->user->get();

//        dd($this->currentLocationId());

        return view('admin.schedule.day')
            ->with('users', $users);
    }

    public function week()
    {
        $users = $this->user->get();

        return view('admin.schedule.week')
            ->with('users', $users);
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
