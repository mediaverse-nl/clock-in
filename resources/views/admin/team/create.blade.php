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

                {!! Form::open(['route' => ['admin.team.store'], 'method' => 'post']) !!}
                {{--{!! Form::hidden('business_id', $business_id) !!}--}}

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
                    {{--@foreach($business->functions as $function)--}}
                        {{--<div class="checkbox">--}}
                            {{--<label>--}}
                                {{--{!! Form::checkbox('functions[]', $function->id, false)!!}--}}
                                {{--{!! $function->value !!}--}}
                            {{--</label>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                </div>

                <small id="emailHelp" class="form-text text-muted">
                    De gebruiker ontvangt een mail bij aanmelding met het wachtwoord.
                </small>
                <br>
                <br>

                {!! Form::submit('Aanmelden', ['class' => 'btn btn-success']) !!}
{{--                <a href="{{route('super.business.edit')}}" class="btn btn-primary">back</a>--}}

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