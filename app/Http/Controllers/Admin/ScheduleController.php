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
