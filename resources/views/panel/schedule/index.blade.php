@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                {{--Standaard beschikbaarheid--}}
                {{--<a href="" class="btn btn-default pull-right">dsads</a>--}}
            {{--</div>--}}
            {{--<div style="height: auto">--}}
                {!! $render->calendar() !!}
            </div>

        </div>
    </div>

@endsection

@push('css')
    <style>

        .fc-day-grid-container{
            height: auto !important;
        }
        #calendar {
            width: 600px;
            margin: 0 auto;
        }
        .fc-time-grid-container{
            height: 100% !important;
        }
    </style>
@endpush

@push('js')
    {!! $render->script() !!}
@endpush