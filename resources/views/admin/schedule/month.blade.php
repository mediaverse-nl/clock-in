@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <a href="{!! route('admin.schedule.week') !!}" class="active btn btn-primary">week</a>
        <a href="{!! route('admin.schedule.departments') !!}" class="btn btn-primary">afdelingen</a>
        <a href="{!! route('admin.schedule.availability') !!}" class="btn btn-primary">team beschikbaarheid</a>
    </div>

    <hr>

    <div class="col-md-12">
        <div class="btn-group pull-left" role="group" aria-label="">
            <a class="btn btn-default"><</a>
            <a class="btn btn-default disabled">{!! \App\Calendar::startOfWeek()->format('d M').' - '.\App\Calendar::endOfMonth()->format('d M') !!}</a>
            <a class="btn btn-default">></a>
        </div>

        <div class="btn-group pull-left" role="group" style="margin: auto 5px;">
            <a href="{!! route('admin.schedule.day') !!}" class="btn btn-default">day</a>
            <a href="{!! route('admin.schedule.week') !!}" class="btn btn-default">week</a>
            <a href="{!! route('admin.schedule.month') !!}" class="active btn btn-default">month</a>
        </div>

        <div class="btn-group pull-right" role="group" style="">
            <a href="" class="btn btn-default"><i class="fas fa-print"></i></a>
            <a href="" class="btn btn-success"><i class="fas fa-upload"></i></a>
        </div>
    </div>

    <hr>

    <div class="col-md-12">
        <table class="table table-responsive" >
            <tr>
                <th colspan="8" class="text-center">{!! $startDate->format('M') !!}</th>
            </tr>
            <tr>
                @for($w = 0; $w < 7; $w++)
                    <th class="text-center {!! \App\Calendar::day() == \App\Calendar::startOfWeek()->addDays($w)->format('d') ? 'success' : '' !!}">
                        <small>
                            {!! \App\Calendar::startOfWeek()->addDays($w)->format('D') !!} <br>
                            {{--20 hrs / &euro;144--}}
                        </small>
                    </th>
                @endfor
            </tr>

            @foreach($calendar as $i)
                <tr class="">
                    @foreach($i['days'] as $d)
                        <td class="{!! $d['disabled'] ? 'active' : ''!!} {!! $d['today'] ? 'success' : ''!!}" style="padding: 0px; border: 1px solid #ddd; height: 100px;">
                            <div class="text-center small" style="background: #dddddd">{!!  ($d['day']) !!}</div>
                            {{--{!! dd($d['event']) !!}--}}
                            @foreach($d['event'] as $e)
                                {!! $e !!}
                            @endforeach

                            {!! $d['today'] !!}
                        </td>
                    @endforeach
                </tr>
            @endforeach


            {{--@for($u = 0; $u < $addWeeks; $u++)--}}
                {{--<tr class="">--}}
                    {{--<th style="width: 200px;">--}}
                        {{--<img class="img-circle" style="vertical-align: top; height: 35px; width: 35px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">--}}
                        {{--<div style="display: inline-block; margin-left: 10px;">--}}
                            {{--willem <br>--}}
                            {{--<small class="mute">--}}
                                {{--{!! random_int(5, 20) !!} hrs--}}
                            {{--</small>--}}
                        {{--</div>--}}
                    {{--</th>--}}
                    {{--@foreach($dateRange as $date)--}}
                        {{--<td style="padding: 5px 1px; border: 1px solid; height: 100px;">--}}
                            {{--{!! $date !!}--}}

                            {{--@if(random_int(0,6) == $s)--}}
                                {{--<div class="panel panel-default" style="margin-bottom: 0px;">--}}
                                    {{--<div class="text-center pane l-body  bg-warning" style="padding: 5px 10px;">--}}
                                        {{--<small><b>12:45-18:25</b></small> <br>--}}
                                        {{--counter--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        {{--</td>--}}
                    {{--@endforeach--}}
                {{--</tr>--}}
            {{--@endfor--}}
        </table>
    </div>


@endsection

@push('css')
    <style>
        .table > tbody > tr > td {
            vertical-align: center;
        }


    </style>
@endpush

@push('js')

@endpush