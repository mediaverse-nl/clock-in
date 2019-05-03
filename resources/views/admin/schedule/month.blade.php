@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <a href="{!! route('admin.schedule.week') !!}" class="active btn btn-primary">week</a>
        <a href="{!! route('admin.schedule.departments') !!}" class="btn btn-primary">afdelingen</a>
        <a href="{!! route('admin.schedule.availability') !!}" class="btn btn-primary">team beschikbaarheid</a>
    </div>

    <hr>

    <div class="col-md-12">
        <div class="btn-group pull-left">
            @component('components.filter', [
                    'items' => $date,
                    'setValue' => $setDate,
                    'name' => 'date',
                    'placeholder' => '',
                ])
            @endcomponent
        </div>

        <div class="btn-group pull-left" role="group" aria-label="" style="margin-left: 5px">
            <div class="form-group">
                @component('components.filter', [
                    'items' => [
                        'gewerkte uren',
                        'ingeroosterde uren',
                        'calendar',
                    ],
                    'setValue' => [],
                    'name' => 'location',
                    'placeholder' => 'alle items',
                ])
                @endcomponent
            </div>
        </div>

        <div class="btn-group pull-left" role="group" aria-label="" style="margin-left: 5px">
            <div class="form-group">
                @component('components.filter', [
                    'items' => $users,
                    'setValue' => [],
                    'name' => 'users',
                    'placeholder' => 'alle gebruikers',
                ])
                @endcomponent
            </div>
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
            {{--<tr style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;" >--}}
                {{--<th colspan="8" class="text-center">{!! $startDate->format('M') !!}</th>--}}
            {{--</tr>--}}
            <tr style="border-left: 1px solid #ddd; border-right: 1px solid #ddd;" >
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
                        <td class="{!! $d['disabled'] ? 'active' : ''!!} {!! $d['today'] ? 'success' : ''!!}" style="padding: 0px; border: 1px solid #ddd; height: 150px;width: 100px;">
                            <div class="text-center small" style="background: #dddddd">{!!  ($d['day']) !!}</div>
                            {{--{!! dd($d['event']) !!}--}}
                            <ul class="calendar-list">
                                @foreach($d['event'] as $e)
                                    <li> {!! $e->user->name !!} - {!! $e->total_worked_min !!}</li>
                                @endforeach
                            </ul>

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
        .ranges ul{
            width: 100% !important;
        }
        .ranges{
            width: 100% !important;
        }
        .drp-calendar{
            display: none !important;
        }
        .calendar-list li{
            background: #0B62A4;
            color: #FFFFFF;
            padding: 2px;
            margin: 2px;
        }
        .calendar-list{
            list-style: none;
            padding: 0px !important;
        }

    </style>
@endpush

@push('js')
    <script>
        $(function() {

            var dateRange = {};
            dateRange["Today"] = [moment(), moment()];
            dateRange["Last 30 Days"] = [moment().subtract(29, 'days'), moment()];
            $('#daterange').daterangepicker({
                startDate: "{!! $startDate !!}",
{{--                endDate: "{!! $endDate !!}",--}}
                ranges: dateRange
            }, function () {
                
            });
            // cb(start, end);
        });

        {{--$(function() {--}}
            {{--$('#daterange').daterangepicker({--}}
                {{--opens: 'right',--}}
                {{--startDate : '{!! $startDate !!}',--}}
                {{--endDate : '{!! $endDate !!}',--}}
{{--                minDate: '{!! \Carbon\Carbon::parse($minDate)->format('d-m-Y')  !!}',--}}
{{--                maxDate: "{!! (\Carbon\Carbon::parse($maxDate)->format('d-m-Y')) !!}"--}}
            {{--}, function(start, end, label) {--}}
                {{--console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));--}}
            {{--});--}}
        {{--});--}}
    </script>
@endpush