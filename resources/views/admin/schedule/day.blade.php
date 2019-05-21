@extends('layouts.admin')

@section('content')

    @php
        function random_color_part() {
            return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
        }

        function random_color() {
            return random_color_part() . random_color_part() . random_color_part();
        }

    //echo random_color()
    @endphp

    <div class="col-md-12" style="margin-bottom: 15px;">
        <a href="{!! route('admin.schedule.day') !!}" class="btn btn-default active">day</a>
        <a href="{!! route('admin.schedule.week') !!}" class="btn btn-default">week</a>
        <a href="{!! route('admin.schedule.month') !!}" class="btn btn-default">month</a>
        {{--<a href="{!! route('admin.schedule.departments') !!}" class="btn btn-primary">afdelingen</a>--}}
        <a href="{!! route('admin.schedule.availability') !!}" class="btn btn-primary">team beschikbaarheid</a>
    </div>

    <div class="col-md-12" style="margin-bottom: 15px;">
        <div class="btn-group pull-left">
            @component('components.filter', [
                'items' => $date->format('Y-m-d'),
                'setValue' => \Carbon\Carbon::parse($setDate)->format('d-m-Y'),
                'name' => 'date',
            ])
            @endcomponent
        </div>
        <div class="btn-group pull-left" role="group" aria-label="" style="margin-left: 5px">
            <div class="form-group">
                @component('components.filter', [
                   'items' => $selectedableUsers,
                   'setValue' => $user,
                   'name' => 'users',
                   'placeholder' => 'alle gebruikers',
               ])
                @endcomponent
            </div>
        </div>
        <div class="btn-group pull-right" role="group" style="">
            <a href="" class="btn btn-default"><i class="fas fa-print"></i></a>
            <a href="" class="btn btn-success"><i class="fas fa-upload"></i></a>
        </div>
    </div>

    <div class="col-md-12">
        <table class="table table-responsive table-striped" >
            <tr>
                <th colspan="8" class="text-center">week 8 / {!!  $date->format('D d M') !!}</th>
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
                    <th class="{!! $date->format('Y-m-d') == \Carbon\Carbon::now()->addDays($w)->format('Y-m-d') ? 'success' : ''  !!}" style="padding: 2px 5px;">
                        <p class="text-center">
                            {!! MinToHumanHours($dayWorkedTime, '%02d uur %02d min') !!}
                            / &euro; --
                        </p>
                        <div class="row" style="padding: 0px 10px">
                            @for ($x = 0; $x <= 23; $x++)
                                <div class="text-center bg-{!! $x%2 ? 'warning':'default' !!} col-md-1" style="padding: 0px; width: 4.16% !important;  display: inline-block;">
                                    <p style="transform: rotate(-45deg);">{!! $x  !!}</p>
                                </div>
                            @endfor
                        </div>
                    </th>
                @endfor


            </tr>
            {{--{!! dd($userList) !!}--}}
            @foreach($userList as $user)
                <tr>
                    <th style="width: 250px;">
                        <img class="img-circle" style="vertical-align: top; height: 35px; width: 35px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
                        <div style="display: inline-block; margin-left: 10px;">
                            {!! $user['user']->name !!} <br>
                             <small class="mute">
                                 {!! MinToHumanHours($user['total_worked_min'], '%02d uur %02d min') !!}
                            </small>
                        </div>
                    </th>

                    <td style="padding: 5px 1px;">

                        <div class="panel panel-default" style="width: 100%; position: relative;">
                            @foreach($user['clocks'] as $clocked)
                                <div data-toggle="tooltip"
                                     title="
                                        <div style='font-size:18px;'>
                                            van <br>
                                            <small>{!! $clocked->started !!}</small>
                                             <br> t/m <br>
                                             <small>{!! $clocked->stopped !!}</small>
                                             <br> <br>
                                             vandaag <br>
                                                {!! MinToHumanHours($clocked->diff_time, '%02d uur %02d min') !!}
                                         </div>
                                     "
                                     data-html="true"
                                     style="height: 8px; display: inline-block; position: absolute; background: #{!! random_color() !!}; color: green; width: {!! $clocked->width !!}%;margin-left: {!! $clocked->leftStartPosition !!}%; margin-bottom: 0px;">
                                </div>

                                {{--<div class="panel panel-default" style="width: 33%;margin-left: {!! rand(0, 66) !!}%; margin-bottom: 0px;">--}}
                                    {{--<div class="text-center pane    l-body  bg-warning" style="padding: 5px 10px;">--}}
                                        {{--<small><b>12:45-18:25</b></small> <br>--}}
                                        {{--counter--}}
                                    {{--</div>--}}
                                {{--</div>--}}
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
{{--                maxDate: "{!! \Carbon\Carbon::now()->format('d-m-Y') !!}",--}}
                {{--startDate: "{!! \Carbon\Carbon::now()->format('d-m-Y') !!}",--}}
                minYear: 2019,
                maxYear: parseInt(moment().format('YYYY'),10)
            }, function(start, end, label) {
//                var years = moment().diff(start, 'years');
//                alert("You are " + years + " years old!");
            });
        });
    </script>
@endpush