@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <div class="row">
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
                            'items' => $locations,
                            'setValue' => $location,
                            'name' => 'location',
                            'placeholder' => 'alle locaties',
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
                    {{--<a href="" class="btn btn-default">print</a>--}}
                    <a href="" class="btn btn-success"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="col-md-12">
        <table class="table table-responsive" style="border: 0px !important;">
            <tr class="active">
                <th class="">datum </th>
                <th>persoon</th>
                <th>time card</th>
                {{--<th>rooster</th>--}}
                <th>gewerkt</th>
                {{--<th>tussen</th>--}}
                <th class="">locatie</th>
                 <th class=""></th>
             </tr>
            @foreach($clocked as $c)
                <tr class="{!! $c->active == 0 ? '' : 'success'!!}">
                    <td class="">
{{--                        {!! $c !!}--}}
                        {!! $c->started_at->format('d M') !!}
                     </td>
                    <td style="width: 200px;">
                        <img class="img-circle" style="height: 35px; width: 35px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
                        <div style="display: inline-block;">
                            {!! $c->user->name !!}
                        </div>
                    </td>
                    <td class="">
                        @if($c->active)
                            <b>{!! $c->started_at->format('H:i') !!} - {!! \Carbon\Carbon::now()->format('H:i') !!}</b>
                        @else
                            <b>{!! $c->started_at->format('H:i') !!} - {!! $c->stopped_at->format('H:i') !!}</b>
                        @endif
                    </td>
                    <td class="">
                        @if(!$c->active)
                            {!! $c->worked_min !!} <small>min</small>
                        @else
                            0 <small>min</small>
                        @endif
                    </td>
                    {{--<td class="">--}}
                        {{--{!!  floor($c->diffInMin() / 60) !!} <small>uur</small> {!! ($c->diffInMin() % 60) !!} <small>min</small>--}}

                    {{--</td>--}}
                    {{--<td class="">--}}
                        {{--@if(!$c->active)--}}
                            {{--{!! $c->worked_min !!}<br>--}}
                            {{--{!! $c->diffInMin() !!}<br>--}}
                            {{--{!! $c->started_at->diffInMinutes($c->stopped_at) !!} <small>min</small>--}}
                        {{--@else--}}
                            {{--{!! $c->diffInMin() !!} <small>min</small>--}}
                        {{--@endif--}}
                    {{--</td>--}}
                    {{--<td class="">--}}
                        {{--<span class="label label-danger">2+</span>--}}
                    {{--</td>--}}
                    <td class="">
                        @if($c->device->location == null)
                            <b>niet bekend</b>
                        @else
                            {!! $c->device->location->fulAddress !!}
                        @endif
                     </td>
                    <td>
                        <a href="" class="btn btn-warning pull-right">
                            <i class="fas fa-edit"></i>
                        </a>
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
                opens: 'right',
                startDate : '{!! $startDate !!}',
                endDate : '{!! $endDate !!}',
                minDate: '{!! \Carbon\Carbon::parse($minDate)->format('d-m-Y')  !!}',
                maxDate: "{!! (\Carbon\Carbon::parse($maxDate)->format('d-m-Y')) !!}"
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });
    </script>
@endpush