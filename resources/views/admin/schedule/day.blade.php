@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <a href="{!! route('admin.schedule.week') !!}" class="active btn btn-primary">week</a>
        <a href="{!! route('admin.schedule.departments') !!}" class="btn btn-primary">afdelingen</a>
        <a href="{!! route('admin.schedule.availability') !!}" class="btn btn-primary">team beschikbaarheid</a>
    </div>

    <hr>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group pull-left" role="group" aria-label="">
                    <a class="btn btn-default"><</a>
                    <a class="btn btn-default disabled">{!! \Carbon\Carbon::now()->format('d M') !!}</a>
                    <a class="btn btn-default">></a>
                </div>

                <div class="btn-group pull-left" role="group" style="margin: auto 5px;">
                    <a href="{!! route('admin.schedule.day') !!}" class="btn btn-default active">day</a>
                    <a href="{!! route('admin.schedule.week') !!}" class="btn btn-default">week</a>
                    <a href="{!! route('admin.schedule.month') !!}" class="btn btn-default">month</a>
                </div>

                <div class="btn-group pull-right" role="group" style="">
                    <a href="" class="btn btn-default"><i class="fas fa-print"></i></a>
                    <a href="" class="btn btn-success"><i class="fas fa-upload"></i></a>
                </div>
            </div>
        </div>
    </div>

    <hr>

    @php
        function timeToPercentage($workingHours){
            $workedHours = 8;
             return number_format((timePosision($workingHours) * 100) / 1440, 0);
        }

        function timePosision($workingHours){
            $timeArray = explode(':', $workingHours);

            $hrs = (int)$timeArray[0];
            $min = (int)$timeArray[1];

            $totalMinutes = $hrs * 60;
            $totalMinutes = $totalMinutes + $min;

            return $totalMinutes;
        }

        echo  timeToPercentage("01:45");

    @endphp

    <div class="col-md-12">
        <table class="table table-responsive table-striped" >
            <tr>
                <th colspan="8" class="text-center">week 8</th>
            </tr>
            <tr>
                <th>
                    <a href="" class="btn btn-sm btn-warning btn-block" data-toggle="modal" data-target="#myModal">asign</a>

                    <!-- Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Modal Header</h4>
                                </div>
                                <div class="modal-body">

                                    

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </th>
                @for($w = 0; $w < 1; $w++)
                    <th class="{!! \App\Calendar::day() == \App\Calendar::startOfWeek()->addDays($w)->format('d') ? 'success' : ''  !!}">
                        <small>
                            {{--{!! \Carbon\Carbon::now()->format('d M') !!}<br>--}}
                        20 hrs / &euro;144</small>
                        <div class="row">
                            {{--<div class="col-md-2 text-left" style="padding: 0px;">--}}
                                {{--00:01--}}
                            {{--</div>--}}
                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs text-right" style="padding: 0px;">
                                04:00
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs text-right" style="padding: 0px;">
                                08:00
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs text-right" style="padding: 0px;">
                                12:00
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs text-right" style="padding: 0px;">
                                16:00
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs text-right" style="padding: 0px;">
                                20:00
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs text-right" style="padding: 0px;">
                                23:59
                            </div>
                        </div>
                    </th>
                @endfor


            </tr>
            @for($u = 0; $u < 5; $u++)
                <tr>
                    <th style="width: 200px;">
                        <img class="img-circle" style="vertical-align: top; height: 35px; width: 35px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
                        <div style="display: inline-block; margin-left: 10px;">
                            willem <br>
                            <small class="mute">
                                {!! random_int(5, 20) !!} hrs
                            </small>
                        </div>
                    </th>
                    @for($s = 0; $s < 1; $s++)
                        @if(random_int(0,1) == $s)
                            <td style="padding: 5px 1px;">
                                <div class="panel panel-default" style="width: 33%;margin-left: {!! rand(0, 66) !!}%; margin-bottom: 0px;">
                                    <div class="text-center pane    l-body  bg-warning" style="padding: 5px 10px;">
                                        <small><b>12:45-18:25</b></small> <br>
                                        counter
                                    </div>
                                </div>
                            </td>
                        @else
                            <td></td>
                        @endif

                    @endfor
                </tr>
            @endfor
        </table>
    </div>


@endsection

@push('css')
    <style>
        .table > tbody > tr > td {
            vertical-align: middle;
        }


    </style>
@endpush

@push('js')

@endpush