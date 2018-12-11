@extends('app.layouts.app')

@section('content')

    <div class="card text-center">
        <div class="card-body">

            <div class="row">
                <div class="col-4" style="font-size: 6em !important;">
                    <i class="far fa-calendar-alt" ></i>
                </div>
                <div class="col-8">
                    {{--<h5 class="card-title">Special title treatment</h5>--}}
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>


        </div>
    </div>

    {{--<div class="col-md-4">--}}
        {{--<a href="{{route('calendar.index')}}">--}}
            {{--<div class="panel panel-default" id="start-panel">--}}
                {{--<div class="panel-body">--}}
                    {{--<i class="fa fa-calendar-alt fa-5x"></i>--}}
                    {{--<div class="pull-right">--}}
{{--                        <p class="text-right">Calendar {{Carbon\Carbon::now()->format('d-m-Y')}}</p>--}}
                        {{--<span class="h1">--}}
                        {{--</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}

    {{--<div class="col-md-4">--}}
        {{--<a href="{{route('clocked.index')}}">--}}
            {{--<div class="panel panel-default" id="start-panel">--}}
                {{--<div class="panel-body">--}}
                    {{--<i class="fa fa-user-clock fa-5x"></i>--}}
                    {{--<div class="pull-right">--}}
                        {{--<p class="text-right">Clocked In</p>--}}
                        {{--<span class="h1">--}}
                        {{--</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}

    {{--<div class="col-md-3">--}}
        {{--<a href="{{route('user.index')}}">--}}
            {{--<div class="panel panel-default" id="start-panel">--}}
                {{--<div class="panel-body">--}}
                    {{--<i class="fa fa-users fa-5x"></i>--}}
                    {{--<div class="pull-right">--}}
                        {{--<span class="h1">--}}
                            {{--Meldingen {{$users->count()}}--}}
                        {{--</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</a>--}}
    {{--</div>--}}

    {{--<div class="col-md-6">--}}

        {{--@component('components.table', ['title' => 'working to day'])--}}

            {{--@slot('head')--}}
                {{--<th>begin tijd</th>--}}
                {{--<th>eind tijd</th>--}}
                {{--<th>user</th>--}}
                {{--<th>clock in</th>--}}
                {{--<th>options</th>--}}
            {{--@endslot--}}

            {{--@slot('body')--}}
                {{--@foreach($calendar->where('title', '=', 'werk') as $c)--}}
                    {{--<tr>--}}
                        {{--<td>{{$c->start->format('d-m-Y H:i')}}</td>--}}
                        {{--<td>{{$c->stop->format('d-m-Y H:i')}}</td>--}}
                        {{--<td>{{$c->user->name}}</td>--}}
                        {{--<td>{{$clock->started_at}}</td>--}}
                        {{--<td>{{$clock->stopped_at}}</td>--}}
                        {{--<td>{{$clock->user->name}}</td>--}}
                        {{--<td>--}}
                            {{--<a href="{{route('clocked.edit', $clock->id)}}" class="btn btn-warning btn-xs">edit</a>--}}
                            {{--<a href="{{route('clocked.show', $clock->id)}}" class="btn btn-success btn-xs">show</a>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
            {{--@endslot--}}
        {{--@endcomponent--}}

    {{--</div>--}}

   {{--<div class="col-md-6">--}}
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
                {{--Dashboard--}}
            {{--</div>--}}
            {{--<div class="panel-body">--}}

                {{--@foreach(DB::table("clocked")--}}
                    {{--->select("*" ,DB::raw("(SUM(worked_min)) as total_min"))--}}
                    {{--->orderBy('created_at')--}}
                    {{--->groupBy(DB::raw("WEEK(created_at)"))--}}
                    {{--->get()->toArray() as $item)--}}

                    {{--{{var_dump($item)}}--}}
                    {{--<br>--}}
                    {{--<br>--}}
                {{--@endforeach--}}

                {{--this month--}}
                {{--{!! $checked->sum('worked_min') !!}--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush