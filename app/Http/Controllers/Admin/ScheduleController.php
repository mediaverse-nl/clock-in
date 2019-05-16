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

        $date = Carbon::now();

        $users = $this->getBusinessFromUser()->users()->get();

        if($this->hasSession('date')){
            $selectedDate = $this->getSessionKey('date');

            if ($selectedDate == 'Invalid date'){
                $this->setItem('date', $date->format('d-m-Y'));
                $setDate = $this->getSessionKey('date');
            }elseif (Carbon::createFromFormat('d-m-Y', $selectedDate) == false)
            {
//                dd(1);
                $this->setItem('date', $date->format('d-m-Y'));
                $setDate = $this->getSessionKey('date');
            }else{
//                dd(1);
//                dd(Carbon::parse($selectedDate));
                $setDate = $this->getSessionKey('date');
            }
        }else{
            $setDate = $date;
        }
        $date = Carbon::parse($setDate);

        $userList = [];
        foreach ($users as $user){
//            dd(1);
             $clocks = $user->clocked()
                 ->whereBetween('started_at', [Carbon::parse($date->format('Y-m-d')), Carbon::parse($date->format('Y-m-d').'23:59:59')])
                 ->where('user_id', '=', $user->id)
                 ->orWhereBetween('stopped_at', [Carbon::parse($date->format('Y-m-d')), Carbon::parse($date->format('Y-m-d').'23:59:59')])
                 ->where('user_id', '=', $user->id)
                 ->orWhere(function ($q) use ($date){
                    $q->where('started_at', '<', Carbon::parse($date->format('Y-m-d')));
                    $q->where('stopped_at', '>', Carbon::parse($date->format('Y-m-d')));
                 })
                 ->where('user_id', '=', $user->id)
                 ->orWhere(function ($q) use ($date){
                    $q->where('stopped_at', '=', null);
                 })
                 ->where('user_id', '=', $user->id)
                 ->get();

//             dd($clocks);

             $times = [];
             foreach ($clocks as $c){
                 $startOfDay = Carbon::parse($date->format('Y-m-d'));
                 $endOfDay = Carbon::parse($date->format('Y-m-d').'23:59:59');
                 $dayInMinutes = 86400;
                 $width = null;

//                 dd(1);
                 if($c->active == 1)
                 {
//                     dd(2);
//                     dd($c->started_at->format('Y-m-d'), $startOfDay->format('Y-m-d'));
                     if($c->started_at->format('Y-m-d') == $startOfDay->format('Y-m-d')){
                         $diffTime = $c->started_at->diffInSeconds($c->stopped_at);
                         $leftStartPosition = number_format(($c->started_at->diffInSeconds($startOfDay) / $dayInMinutes)*100, 2);
                         $width = number_format(($diffTime * 100) / $dayInMinutes, 2);
                     }elseif($startOfDay > $c->started_at->format('Y-m-d')){
                        $diffTime = $c->started_at->diffInSeconds(Carbon::now())
                            - $c->started_at->diffInSeconds($startOfDay);
                        $leftStartPosition = 0;
                        $width = number_format(($diffTime * 100) / $dayInMinutes, 2);
                     }
                 }elseif($c->started_at->format('Y-m-d') < $date->format('Y-m-d')
                    && $c->stopped_at->format('Y-m-d') > $date->format('Y-m-d'))
                 {
                     //started before this day and ended after this day
                     $diffTime = $c->started_at->diffInSeconds($endOfDay);
                     $leftStartPosition = 0;
                     $width = 100;
                 }elseif ($c->stopped_at->format('Y-m-d') > $date->format('Y-m-d')
                    && $date->format('Y-m-d') == $c->started_at->format('Y-m-d'))
                 {
                     //started this day worked boyond that day
                     $diffTime = $c->started_at->diffInSeconds($endOfDay);
                     $leftStartPosition = number_format(($c->started_at->diffInSeconds($startOfDay) / $dayInMinutes)*100, 2);
                     $width = number_format(($diffTime * 100) / $dayInMinutes, 2);
                 }elseif ($c->started_at->format('Y-m-d') < $date->format('Y-m-d')
                     && $date->format('Y-m-d') == $c->stopped_at->format('Y-m-d'))
                 {
                    //started before this day ended this day
                     $diffTime = $c->stopped_at->diffInSeconds($startOfDay);
                     $leftStartPosition = 0;
                     $width = number_format(($diffTime * 100) / $dayInMinutes, 2);
                 }elseif($c->started_at->format('Y-m-d') == $c->stopped_at->format('Y-m-d'))
                 {
                    //started this day ended this day
                     $diffTime = $c->started_at->diffInSeconds($c->stopped_at);
                     $leftStartPosition = number_format(($c->started_at->diffInSeconds($startOfDay) / $dayInMinutes)*100, 2);
                     $width = number_format(($diffTime * 100) / $dayInMinutes, 2);
                 }

                 if ($width != null){
                     $times[] = [
                        'width' => $width,
                        'user_id' => $c->user_id,
                        'leftStartPosition' => $leftStartPosition,
                        'started' => $c->started_at->format('Y-m-d H:i'),
                        'stopped' => $c->stopped_at == null ? Carbon::now()->format('Y-m-d H:i') : $c->stopped_at->format('Y-m-d H:i'),
                        'worked_min' => (int)$c->worked_min,
                        'diff_time' => (int)number_format((int)$diffTime / 60, 0, '', ''),
                     ];
                 }

             }

             $userList[] = [
                'user' => $user,
                'clocks' => $times,
             ];
        }

        return view('admin.schedule.day')
            ->with('users', $users)
            ->with('date', $date)
            ->with('setDate', $setDate)
            ->with('userList', $userList);
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
