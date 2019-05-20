@extends('layouts.admin')

@section('content')

    <div class="col-md-12" style="margin-bottom: 15px;">
        <a href="{!! route('admin.schedule.day') !!}" class="btn btn-default">day</a>
        <a href="{!! route('admin.schedule.week') !!}" class="btn btn-default">week</a>
        <a href="{!! route('admin.schedule.month') !!}" class="active btn btn-default">month</a>
{{--        <a href="{!! route('admin.schedule.departments') !!}" class="btn btn-primary">afdelingen</a>--}}
        <a href="{!! route('admin.schedule.availability') !!}" class="btn btn-primary">team beschikbaarheid</a>
    </div>

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
                            {{--{!! dd($d['event']) !!}--}}
                            <ul class="calendar-list">
                                @foreach($d['event'] as $e)
                                    <li> {!! $e->name !!} - {!! $e->diff_time !!}</li>
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