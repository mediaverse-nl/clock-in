@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 dash-board">
            <div class="panel panel-default">
                <br>
                <div class="panel-body">

                    <div class="col-md-3">
                        <h1><i class="fa fa-wrench"></i> worked <small style="color: #FFFFFF">(this month)</small></h1>
                        <span>{{$worked}}</span>
                    </div>
                    <div class="col-md-3">
                        <h1><i class="fa fa-heart"></i> Active</h1>
                        <span>{{$user->clocked()->where('active', '=', '1')->exists() ? 'working' : 'not working'}}</span>
                    </div>
                    <div class="col-md-3">
                        <h1><i class="fa fa-calendar-alt "></i> Periode</h1>
                        <span>{{Carbon\Carbon::now()->startOfMonth()->format('d-m-Y')}} \ {{Carbon\Carbon::now()->EndOfMonth()->format('d-m-Y')}}</span>
                    </div>
                    <div class="col-md-3">
                        <h1><i class="fa fa-money-bill"></i> Salaris</h1>
                        <span>€ {{$user->payrollThisMonth() * 0.17 }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        @component('components.table', ['title' => 'Clocked'])
            @slot('head')
                <th>worked <small>(min)</small></th>
                <th>started_at</th>
                <th>stopped_at</th>
            @endslot

            @slot('body')
                @foreach($user->clocked as $clocked)
                    <tr>
                        <td>{{$clocked->worked_min}}</td>
                        <td>{{$clocked->started_at}}</td>
                        <td>{{$clocked->stopped_at}}</td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Calendar
            </div>
            <div class="panel-body">
                {!! $render->calendar() !!}

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Gegevens
            </div>
            <div class="panel-body">
                {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'patch']) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    {!! Form::label('name', 'name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => '-- select --']) !!}
                    @include('components.input-error-msg', ['name' => 'name'])
                </div>

                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    {!! Form::label('email', 'email') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'email']) !!}
                    @include('components.input-error-msg', ['name' => 'email'])
                </div>


                {!! Form::submit('save', ['class' => 'btn btn-warning']) !!}

                {!! Form::close() !!}

            </div>
        </div>
    </div>


    {{--<div class="col-md-6">--}}
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">--}}
                {{--Uren log--}}
            {{--</div>--}}
            {{--<div class="panel-body">--}}

                {{--<div class="text-center">--}}
                    {{--<label class="label label-success" style="background: #7A92A3;">Pauze</label>--}}
                    {{--<label class="label label-success" style="background: #0B62A4;">werk</label>--}}
                    {{--<div id="bar-chart"></div>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}


@endsection

@push('js')
{!! $render->script() !!}

<script>
    var data = [
            { y: 'ma', a: 50, b: 90},
            { y: 'di', a: 65,  b: 75},
            { y: 'wo', a: 50,  b: 50},
            { y: 'do', a: 75,  b: 60},
            { y: 'vr', a: 80,  b: 65},
            { y: 'za', a: 90,  b: 70},
            { y: 'zo', a: 100, b: 75}
        ],
        config = {
            data: data,
            xkey: 'y',
            ykeys: ['a', 'b'],
            labels: ['Werk', 'Pauze'],
            fillOpacity: 0.6,
            yLabelFormat: function (y) { return y.toString() + ' uur'; },
            xLabelMargin: 10,
//                xLabelAngle: 45,
            hideHover: 'auto',
            behaveLikeLine: true,
            resize: true,
            pointFillColors:['#ffffff'],
            pointStrokeColors: ['black'],
            lineColors:['gray','red']
        };
    config.element = 'bar-chart';
    config.stacked = true;
    Morris.Bar(config);
</script>
@endpush

@push('css')
<style>
    #area-chart,
    #line-chart,
    #bar-chart,
    #stacked,
    #pie-chart{
        /*min-height: 250px;*/
    }
    .dash-board{
        padding: 0px !important;
        margin-top: -25px;
        color: #FFFFFF;
    }
    .dash-board > .panel{
        border: 0px !important;
        border-radius: 0px !important;
        min-height: 200px;
        background: #3F51B5;
    }
</style>
@endpush
