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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ScheduleController extends Controller
{
    use getLocationTrait, FilterSessionTrait;

    protected $user;
    protected $clock;

    public function __construct(User $user, Clocked $clock)
    {
        $this->user = $user;
        $this->clock = $clock;
    }

    public function day()
    {
        $date = \Carbon\Carbon::parse('2019-04-26')->addDays(0);

        $users = $this->getBusinessFromUser()->users()->get();

        $userList = [];
        foreach ($users as $user){
            $clocks = $user->clocked()
                ->whereBetween('started_at', [Carbon::parse($date->format('Y-m-d')), Carbon::parse($date->format('Y-m-d').'23:59:59')])
                ->orWhereBetween('stopped_at', [Carbon::parse($date->format('Y-m-d')), Carbon::parse($date->format('Y-m-d').'23:59:59')])
                ->where('worked_min', '!=', 0)
                ->get();

            $times = [];
            foreach ($clocks as $clock){
                $diffTime = '';
                $maxTime = 1440;
                $width = 0;
                $startPosition = 0;
                $endPosition = 0;

                if ($date->format('Y-m-d') > $clock->started_at->format('Y-m-d'))
                {
                    $StartPosision = 'before';
                    $diffTime = $clock->stopped_at->diffInMinutes($date->format('Y-m-d H:i'));
                    $worked_today = $diffTime ;
                    $startPosition = 0.00;
                    $width = $clock->timeLength();

                }elseif ($date->format('Y-m-d') < $clock->stopped_at->format('Y-m-d'))
                {
                    $StartPosision = 'after';
                    $diffTime = $clock->started_at->diffInMinutes(Carbon::parse($date->format('Y-m-d').'23:59:59'));
                    $worked_today = $diffTime ;

                    $width = $clock->timeLength();
                    $position = $clock->timePosition();

                    dd($position);
//                    dd($clock->timeToPercentage());
//                    return number_format($position / 1440, 2)

                    $startPosition = 0.01;
                    $endPosition = ($worked_today / $maxTime) * 100;

//                    $worked_today = $clock->worked_min;
                }else{
                    $StartPosision = 'in';
                    $worked_today = $diffTime ;
                    $startPosition = 0.01;
                    $endPosition = ($worked_today / $maxTime) * 100;
                }

                $date->diffInMinutes();
                $times[] = [
                    'width' => $clock->timeLength(),
                    'timeToPercentage' => $clock->timeToPercentage(),
                    'startPosition' => number_format($startPosition, 2),
//                     'width' => $width,
                    'started' => $clock->started_at->format('Y-m-d H:i'),
                    'stopped' => $clock->stopped_at->format('Y-m-d H:i'),
                    'worked_min' => (int)$clock->worked_min,
                    'worked_today' => (int)$worked_today,
                    'start' => $StartPosision,
                    'diff_time' => (int)$diffTime,
                ];
//                dd($times);
            }

            $userList[] = [
                'user' => $user,
                'clocks' => $times,
            ];
        }

        dd($userList);

        return view('admin.schedule.day')
            ->with('users', $users);
    }

    public function week()
    {
        $selectedableUsers = $this->getBusinessFromUser()->users()->pluck('name', 'id');
        $oldestFirst = $this->clock->myBusiness()->oldest('started_at');
        $newestFirst = $this->clock->myBusiness()->latest('started_at');
        $functions = $this->getBusinessFromUser()->functions->pluck('value', 'id');

        $users = $this->getBusinessFromUser()->users()
            ->where(function ($q){
                if ($this->hasSession('users')) {
                    $q->where('id', '=', $this->getSessionKey('users'));
                }
            })
            ->whereHas('userFunctions', function ($q){
                if ($this->hasSession('functions')) {
                    $q->where('function_id', '=', $this->getSessionKey('functions'));
                }
            })
            ->get();

        $selectedUser = null;
        if ($this->hasSession('users')){
            $selectedUser = $this->getSessionKey('users');
        }

        $selectedFunction = null;
        if ($this->hasSession('functions')){
            $selectedFunction = $this->getSessionKey('functions');
        }

        $startDate = Carbon::parse($newestFirst->first()->started_at)->startOfWeek()->format('d-m-Y');
        $endDate = Carbon::parse($newestFirst->first()->started_at)->endOfWeek()->format('d-m-Y');

        if($this->hasSession('date')){
            $dateArray = explode(' - ', $this->getSessionKey('date'));

            $startDate = Carbon::parse($dateArray[0])->startOfWeek()->format('d-m-Y');
            $endDate = Carbon::parse($dateArray[1])->endOfWeek()->format('d-m-Y');

            if (!(bool)strtotime($dateArray[0])
                || !(bool)strtotime($dateArray[1])){
                $this->setItem('date', $startDate.' - '.$endDate);
            }
            $dateArray = explode(' - ', $this->getSessionKey('date'));
            $weekNr = Carbon::parse($dateArray[0])->weekOfYear;
        }else{
            $weekNr = Carbon::now()->weekOfYear;
        }

        $weekRange = [];

        $oldestMonth = Carbon::parse($oldestFirst->first()->started_at)->weekOfYear;
        $newestMonth = Carbon::parse($newestFirst->first()->started_at)->weekOfYear;

        foreach (range($oldestMonth, $newestMonth) as $week){
            $date = Carbon::now();
            $date->setISODate(date('Y'), $week);
            $startOfWeek = Carbon::parse($date)->startOfWeek();
            $endOfWeek = Carbon::parse($date)->endOfWeek();
            $weekRange['W'.$date->format('W'). ' Y'.$date->format('Y')]
                = [$startOfWeek->format('d-m-Y'),
                $endOfWeek->format('d-m-Y')];
        }

        $dateRange = CarbonPeriod::create($startDate, 7);

        $header = [];

        foreach($dateRange as $date)
        {
            $today = Carbon::now()->format('Y-m-d')
                == $date->format('Y-m-d');

            $totalWorkedDay = $this->clock
                ->myBusiness()
                ->whereBetween('started_at', [
                    Carbon::parse($date),
                    Carbon::parse($date->format('Y-m-d').' 23:59:59'),
                ])
                ->sum('worked_min');

            $header[] = [
                'day' => $date->format('D d'),
                'today' => $today,
                'total_worked_min' => $totalWorkedDay,
            ];
        }

        $usersList = [];

        foreach ($users as $user)
        {
            $days = [];

            $weekWorkedMin = $this->clock
                ->myBusiness()
                ->whereBetween('started_at', [
                    Carbon::parse($startDate),
                    Carbon::parse($endDate.' 23:59:59'),
                ])
                ->where('user_id', '=', $user->id)
                ->sum('worked_min');

            foreach($dateRange as $date)
            {
                $today = Carbon::now()->format('Y-m-d')
                    == $date->format('Y-m-d');

                $events = $this->clock
                    ->myBusiness()
                    ->whereBetween('started_at', [
                        Carbon::parse($date),
                        Carbon::parse($date->format('Y-m-d').' 23:59:59'),
                    ])
                    ->where('user_id', '=', $user->id);

                $eventList = $events->get();

                if (count($events->get()) >= 1){
                    $worked_min = collect($events)->sum('worked_min');
                }else{
                    $worked_min = null;
                }

                $days[] = [
                    'day' => $date->format('Y-m-d'),
                    'today' => $today,
                    'events' => $eventList,
                    'worked_min' => $worked_min,
                ];
            }

            $usersList[] = [
                'user' => $user,
                'week' => $days,
                'week_worked_min' => $weekWorkedMin,
            ];
        }

        return view('admin.schedule.week')
            ->with('header', $header)
            ->with('usersList', $usersList)
            ->with('weekRange', $weekRange)
            ->with('startDate', $startDate)
            ->with('endDate', $endDate)
            ->with('dateRange', $dateRange)
            ->with('weekNr', $weekNr)
            ->with('users', $users)
            ->with('selectedableUsers', $selectedableUsers)
            ->with('user', $selectedUser)
            ->with('function', $selectedFunction)
            ->with('functions', $functions);
    }

    public function month()
    {
        $oldestFirst = $this->clock->myBusiness()->oldest('started_at');
        $newestFirst = $this->clock->myBusiness()->latest('started_at');
        $users = $this->getBusinessFromUser()->users->pluck('name', 'id');

        $user = null;
        if ($this->hasSession('users')){
            $user = $this->getSessionKey('users');
        }

        $monthRange = [];

        $oldestMonth = Carbon::parse($oldestFirst->first()->started_at)->month;
        $newestMonth = Carbon::parse($newestFirst->first()->started_at)->month;

        foreach (range($oldestMonth, $newestMonth) as $monthNr){
             $date = Carbon::createFromDate(date('Y'), $monthNr, 1, 0);
             $startOfMonth = Carbon::parse($date)->startOfMonth();
             $endOfMonth = Carbon::parse($date)->endOfMonth();
             $monthRange[$date->format('F')]
                = [$startOfMonth->format('d-m-Y'),
                 $endOfMonth->format('d-m-Y')];
        }

        $startDate = Carbon::parse($newestFirst->first()->started_at)->startOfMonth()->format('d-m-Y');
        $endDate = Carbon::parse($newestFirst->first()->started_at)->endOfMonth()->format('d-m-Y');

        if($this->hasSession('date')){
             $dateArray = explode(' - ', $this->getSessionKey('date'));

             $startDate = Carbon::parse($dateArray[0])->startOfMonth()->format('d-m-Y');
             $endDate = Carbon::parse($dateArray[1])->endOfMonth()->format('d-m-Y');

             if (!(bool)strtotime($dateArray[0])
                 || !(bool)strtotime($dateArray[1])){
                  $this->setItem('date', $startDate.' - '.$endDate);
             }

             $setDate = $this->getSessionKey('date');
        }else{
            $setDate = $startDate.' - '.$endDate;
        }

        $calendar = [];
        $selectedMonth = Carbon::parse($startDate)->month;;

        for ($u = 0; $u < 6; $u++)
        {
            $start = Carbon::createFromDate(date('Y'), $selectedMonth, 1, 0)
                 ->startOfMonth()
                 ->startOfWeek()
                 ->addWeeks($u);

            $dateRange = CarbonPeriod::create($start, 7);

            $days = [];

            foreach($dateRange as $date)
            {
                $status =  Carbon::createFromDate(date('Y'), $selectedMonth, 1, 0)->startOfMonth()->format('Y-m-d') > $date->format('Y-m-d')
                    ||  Carbon::createFromDate(date('Y'), $selectedMonth, 1, 0)->endOfMonth()->format('Y-m-d') < $date->format('Y-m-d');

                $today = Carbon::now()->format('Y-m-d')
                    == $date->format('Y-m-d');

                $events = $this->clock
                    ->myBusiness()
                    ->whereBetween('started_at', [
                        Carbon::parse($date),
                        Carbon::parse($date->format('Y-m-d').' 23:59:59'),
                    ])
                    ->where(function ($q){
                        if($this->hasSession('users')){
                            $q->where('user_id', '=', $this->getSessionKey('users'));
                        }
                    })
                    ->groupBy('user_id')
                    ->selectRaw('*, sum(worked_min) as total_worked_min')
                    ->get();

                $days[] = [
                    'day' => $date->format('Y-m-d'),
                    'disabled' => $status,
                    'today' => $today,
                    'event' => $events,
                ];
            }
            $calendar[] = [
                'days' => $days,
                'weekNumber' => $start->weekOfYear
            ];
        }

        return view('admin.schedule.month')
            ->with('monthRange', $monthRange)
            ->with('startDate', $startDate)
            ->with('users', $users)
            ->with('user', $user)
            ->with('endDate', $endDate)
            ->with('date', $date)
            ->with('setDate', $setDate)
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
