@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <a href="{!! route('admin.team.index') !!}" class="active btn btn-primary">Personeel</a>
        <a href="{!! route('admin.team.roles') !!}" class="btn btn-primary">Roles</a>
    </div>

    <hr>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group pull-left" role="group" aria-label="">
                    <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Voeg een gebruiker toe">
                        <i class="fas fa-plus"></i>
                    </a>
                    <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Groepsbericht maken">
                        <i class="fas fa-comment"></i>
                    </a>
                    <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Klok in codes">
                        <i class="fas fa-user-lock"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <hr>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Gebruiker aanmelden
            </div>
            <div class="panel-body">
                 {!! Form::model($user,['route' => ['admin.team.store'], 'method' => 'post']) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    {!! Form::label('name', 'Volledige Naam') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'name'])
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    {!! Form::label('email', 'E-Mail Adres') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'email'])
                </div>

                <div class="form-group {{ $errors->has('date_of_birth') ? 'has-error' : ''}}">
                    {!! Form::label('date_of_birth', 'date_of_birth') !!}
                    {!! Form::email('date_of_birth', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'date_of_birth'])
                </div>

                <div class="form-group {{ $errors->has('hourly_rate') ? 'has-error' : ''}}">
                    {!! Form::label('hourly_rate', 'hourly_rate') !!}
                    {!! Form::email('hourly_rate', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'hourly_rate'])
                </div>

                <div class="form-group {{ $errors->has('contract_hours') ? 'has-error' : ''}}">
                    {!! Form::label('contract_hours', 'contract_hours') !!}
                    {!! Form::email('contract_hours', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'contract_hours'])
                </div>

                <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                    {!! Form::label('address', 'address') !!}
                    {!! Form::email('address', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'address'])
                </div>

                <div class="form-group {{ $errors->has('address_nr') ? 'has-error' : ''}}">
                    {!! Form::label('address_nr', 'address_nr') !!}
                    {!! Form::email('address_nr', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'address_nr'])
                </div>

                <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : ''}}">
                    {!! Form::label('postal_code', 'postal_code') !!}
                    {!! Form::email('postal_code', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'postal_code'])
                </div>

                <div class="form-group {{ $errors->has('place') ? 'has-error' : ''}}">
                    {!! Form::label('place', 'place') !!}
                    {!! Form::email('place', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'place'])
                </div>

                <div class="form-group {{ $errors->has('place') ? 'has-error' : ''}}">
                    {!! Form::label('place', 'place') !!}
                    {!! Form::email('place', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'place'])
                </div>

                <div class="form-group {{ $errors->has('function') ? 'has-error' : ''}}">
                    {!! Form::label('function', 'Functies') !!}
                    @foreach($user->business->functions as $function)
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('functions[]', $function->id, false)!!}
                                {!! $function->value !!}
                            </label>
                        </div>
                    @endforeach
                </div>

                <br>

                {!! Form::submit('Aanpassen', ['class' => 'btn btn-success']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>


@endsection

@push('css')
    <style>
        .table-bordered>tbody>tr>th{
            border-right-width: 0px !important;
        }
        .table > tbody > tr > td {
            vertical-align: middle;
            padding: 20px 10px;

        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush