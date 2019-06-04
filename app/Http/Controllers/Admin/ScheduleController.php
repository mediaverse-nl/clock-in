<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\Clocked;
use App\Traits\FilterSessionTrait;
use App\Traits\getLocationTrait;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Carbon\Exceptions\InvalidDateException;
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

        $selectedableUsers = $this->getBusinessFromUser()->users()->pluck('name', 'id');

        $selectedUser = null;
        if ($this->hasSession('users')){
            $selectedUser = $this->getSessionKey('users');
        }

        if($this->hasSession('date')){
            $selectedDate = $this->getSessionKey('date');
            try{
                $selectedYear = Carbon::createFromFormat('d-m-Y', $selectedDate)->year;
                if ($selectedYear < $date->year){
                    $this->setItem('date', $date->format('d-m-Y'));
                }
            }catch (\Exception $e){
                $this->setItem('date', $date->format('d-m-Y'));
            }
            $date = Carbon::parse($this->getSessionKey('date'));
            $setDate = $this->getSessionKey('date');
        }else{

            $setDate = $date->format('d-m-Y');
        }

        $users = $this->getBusinessFromUser()
            ->users()
            ->where(function ($q){
                if ($this->hasSession('users')){
                    $q->where('id', '=', $this->getSessionKey('users'));
                }
            })
            ->get();

        $userList = [];
        foreach ($users as $user){
            $clocks = $user->load(['clocked'])->workedToDay($date);

            $times = [];
            foreach ($clocks as $c){
                $times[] = $c->getClockedPosition($date->format('d-m-Y'));
            }

            $userList[] = [
                'user' => $user,
                'clocks' => (object)array_filter($times),
                'total_worked_min' => collect($times)->pluck('diff_time')->sum(),
            ];
        }

        return view('admin.schedule.day')
            ->with('users', $users)
            ->with('date', $date)
            ->with('setDate', $setDate)
            ->with('selectedableUsers', $selectedableUsers)
            ->with('user', $selectedUser)
            ->with('dayWorkedTime', collect($userList)->pluck('total_worked_min')->sum())
            ->with('userList', $userList);
    }

    public function week()
    {
//        $business = new Business();
//
//        $b = $business->find($this->getBusinessFromUser()->id)
//            ->load(['users.clocked']);
//
//        foreach ($b->users as $u){
//            $u;
//            foreach ($u->clocked as $c){
//                $c;
//            }
////            dd($i->clocked);
//        }

//            ->load(['author' => function ($q) {
//                $q->orderBy('created_at', 'asc');
//            }]);

//        return view('admin.dashboard');



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

            $clocks = $this->clock->workedToDay($date);

            $items = [];
            foreach ($clocks as $c){
                $items[] = $c->getClockedPosition($date);
            }

            $header[] = [
                'day' => $date->format('D d'),
                'today' => $today,
                'total_worked_min' => collect($items)->pluck('diff_time')->sum(),
            ];
        }

        $usersList = [];

        foreach ($users as $user)
        {
            $days = [];

            foreach($dateRange as $date)
            {
                $today = Carbon::now()->format('Y-m-d')
                    == $date->format('Y-m-d');

                $clocks = $user->workedToDay($date, $user->id);

                $times = [];
                foreach ($clocks as $c){
                    $times[] = $c->getClockedPosition($date);
                }

                $days[] = [
                    'day' => $date->format('Y-m-d'),
                    'today' => $today,
                    'events' => array_filter($times),
                    'worked_today' => collect($times)->pluck('diff_time')->sum(),
                ];
            }


            $weekWorkedMin = collect($days)->pluck('worked_today')->sum();

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
        if ($this->hasSession('user')){
            $user = $this->getSessionKey('user');
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

                $events = $this->clock->workedToDay($date, $this->getSessionKey('user'));
                $e = [];
                foreach ($events as $event){
                    $e[] = $event->getClockedPosition($date);
                }

                $days[] = [
                    'day' => $date->format('Y-m-d'),
                    'disabled' => $status,
                    'today' => $today,
                    'event' => array_filter($e),
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
