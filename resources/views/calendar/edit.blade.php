@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <span>Calendar Event</span>
                    <div class="pull-right">
                        {!! Form::model($calendar, ['route' => ['calendar.destroy', $calendar->id], 'method' => 'delete']) !!}

                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}

                        {!! Form::close() !!}
                    </div>

                </div>
                <div class="panel-body">
                    {!! Form::model($calendar, ['route' => ['calendar.update', $calendar->id], 'method' => 'patch']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                {!! Form::label('title', 'title *') !!}
                                {!! Form::select('title', \App\Calendar::eventTitle(), null, ['class' => 'form-control']) !!}
                                @include('components.input-error-msg', ['name' => 'title'])
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                {!! Form::label('description', 'description') !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '2']) !!}
                                @include('components.input-error-msg', ['name' => 'description'])
                            </div>

                            <div class="form-group {{ $errors->has('user') ? 'has-error' : ''}}">
                                {!! Form::label('user', 'User') !!}
                                {!! Form::select('user', $users->pluck('name', 'id'), $calendar->user_id, ['class' => 'form-control', 'placeholder' => '-- select user --']) !!}
                                @include('components.input-error-msg', ['name' => 'user'])
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('full_day') ? 'has-error' : ''}}">
                                        {!! Form::checkbox('full_day', null) !!}
                                        {!! Form::label('full_day', 'Full Day') !!}
                                        @include('components.input-error-msg', ['name' => 'full_day'])
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{ $errors->has('private') ? 'has-error' : ''}}">
                                        {!! Form::checkbox('private', $users->pluck('name', 'id'), null) !!}
                                        {!! Form::label('private', 'private') !!}
                                        @include('components.input-error-msg', ['name' => 'private'])
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('start') ? 'has-error' : ''}}">
                                {!! Form::label('start', 'Start *') !!}
                                <div class='input-group date' id='datetimepicker6'>
                                    {!! Form::hidden('start') !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                @include('components.input-error-msg', ['name' => 'start'])

                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('stop') ? 'has-error' : ''}}">
                                {!! Form::label('stop', 'Einde') !!}
                                <div class='input-group date' id='datetimepicker7'>
                                    {!! Form::hidden('stop') !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                                @include('components.input-error-msg', ['name' => 'stop'])

                            </div>
                        </div>
                    </div>

                    {!! Form::submit('Save', ['class' => 'btn btn-success']) !!}

                    {!! Form::close() !!}

                </div>
            </div>
        </div>


    </div>


@endsection

@push('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
<style>
    .bootstrap-datetimepicker-widget {
        font-size:10px;
    }
</style>
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker6').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            inline: true,
            sideBySide: true,
            format : 'YYYY-MM-DD HH:mm'
        });
        $('#datetimepicker7').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            inline: true,
            sideBySide: true,
            format : 'YYYY-MM-DD HH:mm'
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