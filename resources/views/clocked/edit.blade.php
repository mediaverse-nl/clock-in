@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Card
                </div>
                <div class="panel-body">
                    {!! Form::model($clocked, ['route' => ['clocked.update', $clocked->id], 'method' => 'patch']) !!}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('started_at', 'started_at') !!}
                                {!! Form::text('started_at', $clocked->started_at, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('stopped_at', 'stopped_at') !!}
                                <div class="datetimepicker6">
                                    {!! Form::text('stopped_at', $clocked->stopped_at, ['class' => 'form-control', 'disabled']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('worked_min', 'worked_min') !!}
                                {!! Form::text('worked_min', $clocked->worked_min, ['class' => 'form-control', 'disabled']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('active', 'active') !!}
                                {!! Form::checkbox('active', $clocked->active, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group {{ $errors->has('started_at') ? 'has-error' : ''}}">
                                {!! Form::label('started_at', 'Start *') !!}
                                @include('components.input-error-msg', ['name' => 'started_at'])
                                <div class='input-group date' id='datetimepicker6'>
                                    {!! Form::hidden('started_at') !!}
                                    <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">

                            <div class="form-group {{ $errors->has('stopped_at') ? 'has-error' : ''}}">
                                {!! Form::label('stopped_at', 'Einde') !!}
                                @include('components.input-error-msg', ['name' => 'stopped_at'])
                                <div class='input-group date' id='datetimepicker7'>
                                    {!! Form::hidden('stopped_at') !!}
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>

                    {!! Form::submit('Update', ['class' => 'btn']) !!}

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>

@endsection

@push('css')
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
            format : 'YYYY-MM-DD HH:mm',
//            pickSeconds: false

        });
        $('#datetimepicker7').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            inline: true,
            sideBySide: true,
            format : 'YYYY-MM-DD HH:mm',
//            pickSeconds: false,

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
