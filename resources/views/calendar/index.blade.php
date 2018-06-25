@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    {!! $calendar->calendar() !!}

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">

                    {!! Form::open(['route' => ['card.update'], 'method' => 'patch']) !!}

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                        {!! Form::label('title', 'title') !!}
                        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
                        @include('components.input-error-msg', ['name' => 'title'])
                    </div>
                    <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                        {!! Form::label('description', 'description') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'description', 'rows' => '2']) !!}
                        {{--{!! Form::hidden('user_id', $user->id) !!}--}}
                        <small id="emailHelp" class="form-text text-muted">
                            Mag leeg zijn.
                        </small>
                        @include('components.input-error-msg', ['name' => 'description'])
                    </div>

                    <div class="form-group {{ $errors->has('user') ? 'has-error' : ''}}">
                        {!! Form::label('user', 'User') !!}
                        {!! Form::select('user', $users->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => '-- select user --']) !!}
                        <small id="emailHelp" class="form-text text-muted">
                            Mag leeg zijn.
                        </small>
                        @include('components.input-error-msg', ['name' => 'name'])
                    </div>

                    <div class="form-group {{ $errors->has('fullday') ? 'has-error' : ''}}">
                        {!! Form::checkbox('fullday', null) !!}
                        {!! Form::label('fullday', 'Full Day') !!}
                        {!! Form::checkbox('private', $users->pluck('name', 'id'), null) !!}
                        {!! Form::label('private', 'private') !!}
                    </div>

                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker6'>
                                <input type='text' class="form-control hidden" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class='input-group date' id='datetimepicker7'>
                                <input type='text' class="form-control hidden" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>


                    {!! Form::submit('Add', ['class' => 'btn']) !!}

                    {!! Form::close() !!}

                </div>
            </div>
        </div>


    </div>


@endsection

@push('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    {!! $calendar->script() !!}
    <script type="text/javascript">
        $(function () {
            $('#datetimepicker6').datetimepicker({
                inline: true,
                sideBySide: true,
                format : 'DD/MM/YYYY HH:mm'
            });
            $('#datetimepicker7').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                inline: true,
                sideBySide: true,
                format : 'DD/MM/YYYY HH:mm'
            });
            $("#datetimepicker6").on("dp.change", function (e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker7").on("dp.change", function (e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
@endpush