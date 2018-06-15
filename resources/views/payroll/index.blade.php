@extends('layouts.app')

@section('content')

        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Dashboard
                </div>
                <div class="panel-body">

                    {!! $calendar->calendar() !!}

                </div>
            </div>
        </div>


@endsection
@push('js')
{!! $calendar->script() !!}
@endpush