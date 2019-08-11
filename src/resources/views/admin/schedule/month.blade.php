@extends('layouts.admin')

@section('content')

    <ul class="nav nav-tabs" style="margin-bottom: 15px;">
        <li style="margin-left: 15px;">
            <a href="{!! route('admin.schedule.day') !!}" class="btn btn-default">day</a>
        </li>
        <li>
            <a href="{!! route('admin.schedule.week') !!}" class="btn btn-default">week</a>
        </li>
        <li class="active">
            <a href="{!! route('admin.schedule.month') !!}" class="btn btn-default">month</a>
        </li>
        <li>
            <a href="{!! route('admin.schedule.availability') !!}" class="btn btn-primary">team beschikbaarheid</a>
        </li>
    </ul>

    <div class="col-md-12" style="margin-bottom: 15px;">
        <div class="btn-group pull-left">
            @component('components.filter', [
                'items' => $date,
                'setValue' => $setDate,
                'name' => 'date',
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
                    'setValue' => null,
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
                    'setValue' => $user,
                    'name' => 'user',
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
        <table class="table table-responsive" >
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
                            <ul class="calendar-list">
                                @foreach($d['event'] as $e)
{{--                                @foreach(collect($d['event'])->groupBy('user_id')->collapse() as $e)--}}
                                    {{--{!! dd($e) !!}--}}
                                    @if(MinToHumanHours($e->diff_time) != '0 min')
                                    <li style="padding: 5px;">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <small>{!! $e->name !!}</small>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <small class="">{!! MinToHumanHours($e->diff_time) !!}</small>
                                            </div>
                                        </div>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
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
            vertical-align: center;
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
                ranges: {!! collect($monthRange)->toJson() !!}
            }, function () {
                
            });
         });

    </script>
@endpush