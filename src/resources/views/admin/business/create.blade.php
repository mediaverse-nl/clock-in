@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            new business
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => ['super.business.store'], 'method' => 'POST']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('coc_nr', 'coc_nr') !!}
                    {!! Form::text('coc_nr', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('vat_nr', 'vat_nr') !!}
                    {!! Form::text('vat_nr', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bank_name', 'bank_name') !!}
                    {!! Form::text('bank_name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bank_iban', 'bank_iban') !!}
                    {!! Form::text('bank_iban', null, ['class' => 'form-control']) !!}
                </div>
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
                    {!! Form::label('country ', 'country') !!}
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