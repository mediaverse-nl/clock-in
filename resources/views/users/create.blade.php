@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gebruiker aanmelden
                </div>
                <div class="panel-body">

                    {!! Form::open(['route' => ['user.store'], 'method' => 'post']) !!}

                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('name', 'User Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        @include('components.input-error-msg', ['name' => 'name'])
                    </div>
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                        {!! Form::label('email', 'E-Mail Address') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        @include('components.input-error-msg', ['name' => 'email'])
                    </div>

                    <small id="emailHelp" class="form-text text-muted">
                        De gebruiker ontvangt een mail bij aanmelding met het wachtwoord.
                    </small>
                    <br>
                    <br>

                    {!! Form::submit('Aanmelden', ['class' => 'btn']) !!}

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>


@endsection

@push('js')
    <script>

    </script>
@endpush

@push('css')
    <style>

    </style>
@endpush
