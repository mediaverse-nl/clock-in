@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <a href="{!! route('admin.schedule.day') !!}" class="btn btn-default">day</a>
        <a href="{!! route('admin.schedule.week') !!}" class="btn btn-default">week</a>
        <a href="{!! route('admin.schedule.month') !!}" class="btn btn-default">month</a>
        {{--<a href="{!! route('admin.schedule.departments') !!}" class="btn btn-primary">afdelingen</a>--}}
        <a href="{!! route('admin.schedule.availability') !!}" class="btn btn-primary active">team beschikbaarheid</a>
    </div>

    <br>
    <br>
    <br>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group pull-left" role="group" aria-label="">
                            <a class="btn btn-default"><</a>
                            <a class="btn btn-default disabled">{!! \App\Calendar::startOfWeek()->format('d M').' - '.\App\Calendar::endOfWeek()->format('d M') !!}</a>
                            <a class="btn btn-default">></a>
                        </div>

                        <div class="btn-group pull-left" role="group" style="margin: auto 5px;">
                            <a href="" class="btn btn-default">day</a>
                            <a href="" class="btn btn-default active">week</a>
                            <a href="" class="btn btn-default">month</a>
                        </div>

                        {{--<div class="btn-group pull-right" role="group" style="">--}}
                            {{--<a href="" class="btn btn-default">print</a>--}}
                            {{--<a href="" class="btn btn-success">publish</a>--}}
                        {{--</div>--}}
                    </div>
                </div>

                <hr>

                <table class="table table-responsive table-striped" >
                    <tr>
                        <th colspan="8" class="text-center">week 8</th>
                    </tr>
                    <tr>
                        <th></th>
                        @for($w = 0; $w < 7; $w++)
                            <th class="text-center {!! \App\Calendar::day() == \App\Calendar::startOfWeek()->addDays($w)->format('d') ? 'success' : ''  !!}">
                                {!! \App\Calendar::startOfWeek()->addDays($w)->format('D d') !!} <br>
                            </th>
                        @endfor
                    </tr>
                    @for($u = 0; $u < 7; $u++)
                        <tr>
                            <th style="width: 200px;">
                                <img class="img-circle" style=" height: 35px; width: 35px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
                                <span style="vertical-align: middle; margin-left: 10px;">willem</span>
                            </th>
                            @for($s = 1; $s < 8; $s++)
                                @if(random_int(1,6) == $s)
                                    <td style="margin: 2px;">
                                        <div class="panel panel-default" style="margin-bottom: 0px;">
                                            <div class="text-center panel-body bg-info" style="padding: 5px 10px;">
                                                <small><b>12:45-18:25</b></small> <br>
                                            </div>
                                        </div>
                                    </td>
                                @else
                                    <td>
                                        @if(random_int(1,6) == $s)
                                            <div class="panel panel-default" style="margin-bottom: 0px;">
                                                <div class="text-center panel-body bg-danger" style="padding: 5px 10px;">
                                                    <small><b>x</b></small> <br>
                                                </div>
                                            </div>
                                        @else

                                        @endif
                                    </td>
                                @endif

                            @endfor
                        </tr>
                    @endfor


                </table>
            </div>
        </div>

    </div>

@endsection

@push('css')
    <style>
        .table > tbody > tr > th,
        .table > tbody > tr > td {
            vertical-align: middle;
        }
    </style>
@endpush

@push('js')

@endpush