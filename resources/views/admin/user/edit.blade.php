@extends('layouts.app')

@section('content')

    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit user
            </div>
            <div class="panel-body">
                {!! Form::model($user, ['route' => ['super.user.update', $user->id], 'method' => 'PATCH']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'email') !!}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'password') !!}
                        {!! Form::text('password', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('date_of_birth', 'date_of_birth') !!}
                        {!! Form::text('date_of_birth', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('hourly_rate', 'hourly_rate') !!}
                        {!! Form::text('hourly_rate', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('contract_hours', 'contract_hours') !!}
                        {!! Form::text('contract_hours', null, ['class' => 'form-control']) !!}
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
                        {!! Form::label('created_at', 'created_at') !!}
                        {!! Form::text('created_at', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('updated_at', 'updated_at') !!}
                        {!! Form::text('updated_at', null, ['class' => 'form-control']) !!}
                    </div>
                    {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}
                    <a href="{{route('super.business.edit', $user->business->id)}}" class="btn btn-primary">back</a>
                {!! Form::close() !!}
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