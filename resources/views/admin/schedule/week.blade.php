@extends('layouts.admin')

@section('content')

    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
        <li style="margin-left: 15px;">
            <a href="{!! route('admin.schedule.day') !!}" class="btn btn-default">day</a>
        </li>
        <li class="active">
            <a href="{!! route('admin.schedule.week') !!}" class="btn btn-default">week</a>
        </li>
        <li>
            <a href="{!! route('admin.schedule.month') !!}" class="btn btn-default">month</a>
        </li>
        <li>
            <a href="{!! route('admin.schedule.availability') !!}" class="btn btn-primary">team beschikbaarheid</a>
        </li>
    </ul>

    <div class="col-md-12" style="margin-bottom: 15px;">

        <div class="btn-group pull-left">
            @component('components.filter', [
                'items' => [],
                'setValue' => $startDate.' - '.$endDate,
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

        <div class="btn-group pull-left" role="group" aria-label="" style="margin-left: 5px">
            <div class="form-group">
                 @component('components.filter', [
                    'items' => $functions,
                    'setValue' => $function,
                    'name' => 'functions',
                    'placeholder' => 'alle functies',
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
        <table class="table table-responsive" >
            <tr>
                <th colspan="8" class="text-center">week {!! $weekNr !!}</th>
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

                                    {{--rooster maken--}}
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Beschikbaarheid van week {!! \Carbon\Carbon::now()->weekOfYear !!}
                                            </div>
                                            <div class="panel-body">

                                                @component('components.admin.planner')

                                                @endcomponent

                                            </div>
                                        </div>
                                    </div>
                                    {{--einde rooster maken--}}

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </th>
                @foreach($header as $date)
                    <th class="text-center {!! $date['today'] ? 'success' : null !!}">
                        <small>
                            {!! $date['day'] !!}
                             <br>
                            {!! MinToHumanHours($date['total_worked_min'], '%02d uur %02d min') !!}
                            <br>
                            &euro; --
                        </small>
                    </th>
                @endforeach
            </tr>

            {{--default events--}}
            <tr class="active">
                <td></td>
                <td>
                    <div class="panel panel-default" style="margin-bottom: 0px;">
                        <div class="text-center bg-active" style="background-color: #e3e3e3; padding: 1px 10px;">
                            <small><b>12:45-18:25</b></small> <br>
                            feestdag
                        </div>
                    </div>
                </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
            {{--end default events--}}

            {{--{!! dd($usersList) !!}--}}
            @foreach($usersList as $user)
                <tr class="">
                    <th style="width: 200px;" class="{!! $date['today'] ? 'success' : null !!}">
                        <div style="width: 200px;">
                            <img class="img-circle" style="vertical-align: top; height: 35px; width: 35px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
                            <div style="display: inline-block; margin-left: 10px;">
                                 {!! $user['user']->name !!} <br>
                                 <small class="mute">
                                    {!! MinToHumanHours($user['week_worked_min'], '%02d uur %02d min') !!}
                                 </small>
                            </div>
                            <br>
                            @foreach($user['user']->userFunctions as $f)
                                <span class="badge badge-success small">{!! $f->functions->shortNames() !!}</span>
                            @endforeach
                        </div>
                    </th>
                    @foreach($user['week'] as $date)
                        <td style="padding: 5px 1px; width: 14.28%">
                            @if(count($date['events']))
                                <div class="panel panel-default " style="margin-bottom: 0px;">
                                    <div class="text-center panel-body bg-{!! $date['today'] ? 'success' : 'warning'!!}" style="padding: 5px 10px;">
                                        <span rel="tooltip"
                                              data-toggle="tooltip"
                                              data-html="true"
                                              data-title="
                                                 @foreach($date['events'] as $clock)
                                                      {{--{!! $clock !!}--}}
                                                     <small><b>{!! $clock->started.' - '.$clock->stopped !!}</b></small> <br>
                                                 @endforeach
                                              ">
                                            {!! MinToHumanHours($date['worked_today'], '%02d uur %02d min') !!}
                                        </span>
                                        <i class="fas fa-ellipsis-v"></i>
                                    </div>
                                </div>
                            @endif
                        </td>
                     @endforeach
                </tr>
            @endforeach
        </table>
    </div>


@endsection

@push('css')
    <style>
        .nav-tabs>li {
            float: left;
            margin-bottom: -2px !important;
        }
        .nav-tabs>li>a{
            border: #ddd ;
        }

        .table > tbody > tr > td {
            vertical-align: middle;
        }
        .ranges ul{
            width: 100% !important;
        }
        .ranges{
            width: 100% !important;
        }
        .ranges li:last-child {
            display: none !important;
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

            $('#daterange').daterangepicker({
                startDate: "{!! $startDate !!}",
                endDate: "{!! $endDate !!}",
                ranges: {!! collect($weekRange)->toJson() !!}
            }, function () {

            });
        });
    </script>
@endpush