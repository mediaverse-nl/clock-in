<?php

namespace App\Http\Controllers\Admin;

use App\Clocked;
use App\Traits\FilterSessionTrait;
use App\Traits\getLocationTrait;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ScheduleController extends Controller
{
    use FilterSessionTrait, getLocationTrait;

    protected $user;
    protected $clock;

    public function __construct(User $user, Clocked $clock)
    {
        $this->user = $user;
        $this->clock = $clock;
    }

    public function day()
    {
        $users = $this->user->get();

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
        $clock = $this->clock->whereHas('user.business', function ($q){
            $q->where('id', '=', $this->getBusinessFromUser()->id);
        });

        $calendar = [];
        $selectedMonth = Input::has('month')
            ? Input::get('month') : -1;

        for ($u = 0; $u < 6; $u++)
        {
            $startDate = Carbon::now()
                ->addMonths($selectedMonth)
                ->startOfMonth()
                ->startOfWeek()
                ->addWeeks($u);

            $dateRange = CarbonPeriod::create($startDate, 7);

            $days = [];

            foreach($dateRange as $date)
            {
                $status = Carbon::now()->startOfMonth()->addMonths($selectedMonth)->format('Y-m-d') > $date->format('Y-m-d')
                    || Carbon::now()->addMonths($selectedMonth)->endOfMonth()->format('Y-m-d') < $date->format('Y-m-d');

                $today = Carbon::now()->format('Y-m-d')
                    == $date->format('Y-m-d');

                $events = $clock;


//                dd(Carbon::parse($date->format('Y-m-d'))->toDateString());

                $events = $events->whereDate('started_at', Carbon::parse($date->format('Y-m-d'))->toDateString())->get();

                $days[] = [
                    'day' => $date->format('Y-m-d'),
                    'disabled' => $status,
                    'today' => $today,
                    'event' => $events,
                ];
            }
            $calendar[] = [
                'days' => $days,
                'weekNumber' => $startDate->weekOfYear
            ];
        }

        return view('admin.schedule.month')
            ->with('startDate', $startDate)
            ->with('calendar', $calendar);
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
