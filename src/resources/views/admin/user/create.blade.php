@extends('layouts.app')

@section('content')

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Gebruiker aanmelden
            </div>
            <div class="panel-body">

                {!! Form::open(['route' => ['super.user.store'], 'method' => 'post']) !!}
                {!! Form::hidden('business_id', $business_id) !!}

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

                <div class="form-group {{ $errors->has('function') ? 'has-error' : ''}}">
                    {!! Form::label('function', 'User Function') !!}
                    @foreach($business->functions as $function)
                        <div class="checkbox">
                            <label>
                                {!! Form::checkbox('functions[]', $function->id, false)!!}
                                {!! $function->value !!}
                            </label>
                        </div>
                    @endforeach
                </div>

                <small id="emailHelp" class="form-text text-muted">
                    De gebruiker ontvangt een mail bij aanmelding met het wachtwoord.
                </small>
                <br>
                <br>

                {!! Form::submit('Aanmelden', ['class' => 'btn btn-success']) !!}
                <a href="{{route('super.business.edit', $business_id)}}" class="btn btn-primary">back</a>

                {!! Form::close() !!}

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
