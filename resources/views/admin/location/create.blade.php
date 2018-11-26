@extends('layouts.app')

@section('content')



    <div class="panel panel-default">
        <div class="panel-heading">
            new location
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => ['super.location.store'], 'method' => 'POST']) !!}
                {!! Form::hidden('business_id', $business_id, ['class' => 'form-control']) !!}

                <div class="form-group">
                    {!! Form::label('address', 'address') !!}
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('address_nr', 'address_nr') !!}
                    {!! Form::text('address_nr', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('postal_code', 'postal_code') !!}
                    {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('place', 'place') !!}
                    {!! Form::text('place', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country', 'country') !!}
                    {!! Form::text('country', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                <a href="{{route('super.business.index')}}" class="btn btn-primary">back</a>

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