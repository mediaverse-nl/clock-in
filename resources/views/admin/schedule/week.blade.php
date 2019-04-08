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
                    <a class="btn btn-default disabled">{!! \App\Calendar::startOfWeek()->format('d M').' - '.\App\Calendar::endOfWeek()->format('d M') !!}</a>
                    <a class="btn btn-default">></a>
                </div>

                <div class="btn-group pull-left" role="group" style="margin: auto 5px;">
                    <a href="{!! route('admin.schedule.day') !!}" class="btn btn-default">day</a>
                    <a href="{!! route('admin.schedule.week') !!}" class="btn btn-default active">week</a>
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

    <div class="col-md-12">
        <table class="table table-responsive" >
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
                @for($w = 0; $w < 7; $w++)
                    <th class="text-center {!! \App\Calendar::day() == \App\Calendar::startOfWeek()->addDays($w)->format('d') ? 'success' : '' !!}">
                        <small>
                            {!! \App\Calendar::startOfWeek()->addDays($w)->format('D d') !!} <br>
                            20 hrs / &euro;144
                        </small>
                    </th>
                @endfor
            </tr>

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

            @for($u = 0; $u < 5; $u++)
                <tr class="">
                    <th style="width: 200px;">
                        <img class="img-circle" style="vertical-align: top; height: 35px; width: 35px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
                        <div style="display: inline-block; margin-left: 10px;">
                            willem <br>
                            <small class="mute">
                                {!! random_int(5, 20) !!} hrs
                            </small>
                        </div>
                    </th>
                    @for($s = 0; $s < 7; $s++)
                        @if(random_int(0,6) == $s)
                            <td style="padding: 5px 1px;">
                                <div class="panel panel-default" style="margin-bottom: 0px;">
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