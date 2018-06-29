@extends('layouts.app')

@section('content')



    <div class="col-md-3">
        <a href="{{route('user.index')}}">
            <div class="panel panel-default" id="start-panel">
                <div class="panel-body">
                    <i class="fa fa-users fa-5x"></i>
                    <div class="pull-right">
                        <span class="h1">
                            Users {{$users->count()}}
                        </span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{route('calendar.index')}}">
            <div class="panel panel-default" id="start-panel">
                <div class="panel-body">
                    <i class="fa fa-calendar-alt fa-5x"></i>
                    <div class="pull-right">
                        <p class="text-right">{{Carbon\Carbon::now()->format('d-m-Y')}}</p>
                        <span class="h1">
                            Calendar ({{$calendarEvents}})
                        </span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{route('user.index')}}">
            <div class="panel panel-default" id="start-panel">
                <div class="panel-body">
                    <i class="fa fa-users fa-5x"></i>
                    <div class="pull-right">
                        <span class="h1">
                            Users {{$users->count()}}
                        </span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{route('user.index')}}">
            <div class="panel panel-default" id="start-panel">
                <div class="panel-body">
                    <i class="fa fa-users fa-5x"></i>
                    <div class="pull-right">
                        <span class="h1">
                            Users {{$users->count()}}
                        </span>
                    </div>
                </div>
            </div>
        </a>
    </div>


    <div class="col-md-6">


        @component('components.table', ['title' => 'clocked'])

            @slot('head')
                <th>worked_min</th>
                <th>worked</th>
                <th>user</th>
                <th>clock in</th>
                <th>options</th>
            @endslot

            @slot('body')
                {{--@foreach($clocks as $clock)--}}
                    {{--<tr>--}}
                        {{--<td>{{$clock->worked_min}}</td>--}}
                        {{--<td>{{$clock->started_at}}</td>--}}
                        {{--<td>{{$clock->stopped_at}}</td>--}}
                        {{--<td>{{$clock->user->name}}</td>--}}
                        {{--<td>--}}
                            {{--<a href="{{route('clocked.edit', $clock->id)}}" class="btn btn-warning btn-xs">edit</a>--}}
                            {{--<a href="{{route('clocked.show', $clock->id)}}" class="btn btn-success btn-xs">show</a>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
            @endslot
        @endcomponent

    </div>

   <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Dashboard
            </div>
            <div class="panel-body">

                @foreach(DB::table("clocked")
                    ->select("*" ,DB::raw("(SUM(worked_min)) as total_min"))
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("WEEK(created_at)"))
                    ->get()->toArray() as $item)

                    {{var_dump($item)}}
                    <br>
                    <br>
                @endforeach

                this month
                {!! $checked->sum('worked_min') !!}

            </div>
        </div>
    </div>


@endsection

@push('css')
    <style>
        #start-panel{
            background: #2ab27b; border: none;
        }
        #start-panel .fa,
        #start-panel p,
        #start-panel span {
            color: #ffffff;
        }
        #start-panel > .panel-body > div > .h1{
            vertical-align: bottom !important;
            display: inline-block;
            color: #fff;
            margin-top: auto;
            margin-bottom: auto;
        }
    </style>
@endpush

@push('js')

@endpush