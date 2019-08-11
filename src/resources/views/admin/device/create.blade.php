@extends('layouts.app')

@section('content')



    <div class="panel panel-default">
        <div class="panel-heading">
            add new device to business
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => ['super.device.store'], 'method' => 'POST']) !!}
                {!! Form::hidden('location_id', $location_id, ['class' => 'form-control']) !!}

                <div class="form-group">
                    {!! Form::label('device', 'device') !!}
                    {!! Form::select('device', $devices->pluck('serial_nr', 'id'), null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                </div>

                {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                <a href="{{route('super.business.edit', $location_id)}}" class="btn btn-primary">back</a>

            {!! Form::close() !!}
        </div>
    </div>


@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush