@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>Calendar Event</span>
            </div>
            <div class="panel-body">
                {!! Form::model($calendar, ['route' => ['calendar.update', $calendar->id], 'method' => 'patch']) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('title', 'title *') !!}
                            {!! Form::text('title', null, ['class' => 'form-control', 'disabled']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'description') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'disabled', 'rows' => '2']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('user', 'User') !!}
                            {!! Form::text('user', $calendar->user_id, ['class' => 'form-control', 'disabled']) !!}
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::checkbox('full_day', null) !!}
                                    {!! Form::label('full_day', 'hele dag') !!}
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('start', 'Start *') !!}
                            <div class='input-group date' id='datetimepicker6'>
                                {!! Form::hidden('start') !!}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('stop', 'Einde') !!}
                            <div class='input-group date' id='datetimepicker7'>
                                {!! Form::text('stop', null, ['class' => 'hidden']) !!}
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{route('auth.dashboard')}}" class="btn btn-primary">terug</a>
                {!! Form::close() !!}

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
//        $('#datetimepicker6').datepicker('disable');
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