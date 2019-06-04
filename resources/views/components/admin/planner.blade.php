{!! Form::open(['route' => ['admin.filter.flash'], 'method' => 'post']) !!}

<div>
    <table style="width:100%">
        <tr>
            <th width="100px;">dag</th>
            <th colspan="">van</th>
            <th colspan="">tot</th>
        </tr>
        <tr class="time-chart">
            <td>{!! \Carbon\Carbon::now()->startOfWeek()->addDays(0)->format('D d M') !!}</td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr class="time-chart">
            <td>{!! \Carbon\Carbon::now()->startOfWeek()->addDays(1)->format('D d M') !!}</td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr class="time-chart">
            <td>{!! \Carbon\Carbon::now()->startOfWeek()->addDays(2)->format('D d M') !!}</td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr class="time-chart">
            <td>{!! \Carbon\Carbon::now()->startOfWeek()->addDays(3)->format('D d M') !!}</td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr class="time-chart">
            <td>{!! \Carbon\Carbon::now()->startOfWeek()->addDays(4)->format('D d M') !!}</td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr class="time-chart">
            <td>{!! \Carbon\Carbon::now()->startOfWeek()->addDays(5)->format('D d M') !!}</td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
        </tr>
        <tr class="time-chart">
            <td>{!! \Carbon\Carbon::now()->startOfWeek()->addDays(6)->format('D d M') !!}</td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
            <td>
                <div class="form-group">
                    <div class="input-group date datetimepicker">
                        <input type="text" class="form-control" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>


{!! Form::close() !!}

@push('css')
    <style>
        .time-chart td{
            padding: 0px 3px;
        }
        .time-chart .form-group{
            margin-bottom: 5px;
        }
    </style>
@endpush

@push('js')
    <script>
        $(function () {

            $('.datetimepicker').datetimepicker({
                format: 'LT'
            });

            $('#datetimepicker6').datetimepicker();
            $('#datetimepicker7').datetimepicker({
                useCurrent: false //Important! See issue #1075
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