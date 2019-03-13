@extends('layouts.admin')

@section('content')

    {{--<div class="col-md-12">--}}
        {{--<a href="" class="btn btn-primary">dashboard</a>--}}
        {{--<a href="" class="btn btn-primary">rooster</a>--}}
        {{--<a href="" class="btn btn-primary">time tracking</a>--}}
        {{--<a href="" class="btn btn-primary">team</a>--}}
        {{--<a href="" class="btn btn-primary">reports</a>--}}
        {{--<a href="" class="btn btn-primary">settings</a>--}}
    {{--</div>--}}

    <div class="col-md-12">
        <a href="" class="btn btn-primary active">week</a>
        <a href="" class="btn btn-primary">Roles/afdelingen</a>
        <a href="" class="btn btn-primary">team beschikbaarheid</a>
    </div>

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

                        <div class="btn-group pull-right" role="group" style="">
                            <a href="" class="btn btn-default">print</a>
                            <a href="" class="btn btn-success">publish</a>
                        </div>
                    </div>
                </div>

                <hr>

                <table border="1" class="table table-responsive table-striped" >
                    <tr>
                        <th colspan="8" class="text-center">week 8</th>
                    </tr>
                    <tr>
                        <th><a href="" class="btn btn-sm btn-default btn-block">asign</a></th>
                        @for($w = 0; $w < 7; $w++)
                            <th class="text-center {!! \App\Calendar::day() == \App\Calendar::startOfWeek()->addDays($w)->format('d') ? 'success' : ''  !!}">
                                {!! \App\Calendar::startOfWeek()->addDays($w)->format('D d') !!} <br>
                                <small>20 hrs / &euro;144</small>
                            </th>
                        @endfor
                    </tr>
                    @for($u = 0; $u < 3; $u++)
                        <tr>
                            <th style="width: 200px;">
                                <img class="img-circle" style="vertical-align: top; height: 35px; width: 35px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
                                <div style="display: inline-block;">
                                    willem <br>
                                    <small class="mute">
                                        {!! random_int(5, 20) !!} hrs
                                    </small>
                                </div>
                            </th>
                            @for($s = 0; $s < 7; $s++)
                                @if(random_int(0,6) == $s)
                                <td style="margin: 2px;">
                                    <div class="panel panel-default">
                                        <div class="text-center panel-body" style="padding: 5px 10px;">
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
        </div>

    </div>


@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush