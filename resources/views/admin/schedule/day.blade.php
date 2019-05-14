@extends('layouts.admin')

@section('content')

    @php
        //$date = \Carbon\Carbon::parse('2019-04-26')->addDays(0);
        //$formattedDate = $date->format('Y-m-d');

        function random_color_part() {
            return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
        }

        function random_color() {
            return random_color_part() . random_color_part() . random_color_part();
        }

    //echo random_color()
    @endphp

    <div class="col-md-12">
        <a href="{!! route('admin.schedule.day') !!}" class="btn btn-default active">day</a>
        <a href="{!! route('admin.schedule.week') !!}" class="btn btn-default">week</a>
        <a href="{!! route('admin.schedule.month') !!}" class="btn btn-default">month</a>
        <a href="{!! route('admin.schedule.departments') !!}" class="btn btn-primary">afdelingen</a>
        <a href="{!! route('admin.schedule.availability') !!}" class="btn btn-primary">team beschikbaarheid</a>
    </div>

    <hr>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                @component('components.filter', [
                    'items' => $date->format('Y-m-d'),
                    'setValue' => $setDate,
                    'name' => 'date',
                ])
                @endcomponent
                {{--<div class="btn-group pull-left" role="group" aria-label="">--}}
                    {{--<input class="btn btn-default" type="text" name="birthday" value="{!! $date->format('Y-m-d') !!}" />--}}

                    {{--<a class="btn btn-default"><</a>--}}
                    {{--<a class="btn btn-default disabled">{!! $date->format('d M') !!}</a>--}}
                    {{--<a class="btn btn-default">></a>--}}
                {{--</div>--}}

                <div class="btn-group pull-right" role="group" style="">
                    <a href="" class="btn btn-default"><i class="fas fa-print"></i></a>
                    <a href="" class="btn btn-success"><i class="fas fa-upload"></i></a>
                </div>
            </div>
        </div>
    </div>

    <hr>



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
                    <th class="{!! \App\Calendar::day() == \App\Calendar::startOfWeek()->addDays($w)->format('d') ? 'success' : ''  !!}" style="padding: 2px 5px;">
                        <p class="text-center">
                            {{--{!! \Carbon\Carbon::now()->format('d M') !!}<br>--}}
                        20 hrs / &euro; --</p>
                        <div style="">

                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs" style="padding: 0px;">
                                <div class="row">
                                    <div class="text-left col-sm-6  col-md-6">01</div>
                                    <div class="text-right col-sm-6 col-md-6">04</div>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs text-right" style="padding: 0px;">
                                08
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs text-right" style="padding: 0px;">
                                12
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs text-right" style="padding: 0px;">
                                16
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs text-right" style="padding: 0px;">
                                20
                            </div>
                            <div class="col-md-2 col-sm-2 col-lg-2 hidden-xs text-right" style="padding: 0px;">
                                23
                            </div>
                        </div>
                    </th>
                @endfor


            </tr>
            @foreach($userList as $user)
                <tr>
                    <th style="width: 250px;">
                        <img class="img-circle" style="vertical-align: top; height: 35px; width: 35px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
                        <div style="display: inline-block; margin-left: 10px;">
                            {!! $user['user']->name !!} <br>
                            <small class="mute">
                                {!! random_int(5, 20) !!} hrs
                            </small>
                        </div>
                    </th>

                    <td style="padding: 5px 1px;">

                        <div class="panel panel-default" style="width: 100%; position: relative;">
                            @foreach($user['clocks'] as $clocked)
                                <div data-toggle="tooltip"
                                     title="van <br>  {!! $clocked['started'] !!} <br> t/m <br>  {!! $clocked['stopped'] !!} <br> gewerkte min {!! $clocked['diff_time'] !!}"
                                     data-html="true"
                                     style="height: 8px; display: inline-block; position: absolute; background: #{!! random_color() !!}; color: green; width: {!! $clocked['width'] !!}%;margin-left: {!! $clocked['leftStartPosition'] !!}%; margin-bottom: 0px;">
                                </div>

                                <div class="panel panel-default" style="width: 33%;margin-left: {!! rand(0, 66) !!}%; margin-bottom: 0px;">
                                    <div class="text-center pane    l-body  bg-warning" style="padding: 5px 10px;">
                                        <small><b>12:45-18:25</b></small> <br>
                                        counter
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </td>
                </tr>
            @endforeach

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
    <script>
        $(function() {
            $('#daterange').daterangepicker({
                singleDatePicker: true,
//                showDropdowns: true,
                startDate: "{!! $setDate !!}",
                minYear: 2019,
                maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
//                var years = moment().diff(start, 'years');
//                alert("You are " + years + " years old!");
            });
        });
    </script>
@endpush