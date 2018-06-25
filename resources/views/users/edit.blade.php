@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 dash-board">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="col-md-3">
                        <h1>worked <small style="color: #FFFFFF">(this month)</small></h1>
                        <span>{{number_format($user->payrollThisMonth() / 60)}}</span>
                    </div>
                    <div class="col-md-3">
                        <h1>Active</h1>
                        <span></span>
                    </div>
                    <div class="col-md-3">
                        <h1>Periode</h1>
                        <span>{{Carbon\Carbon::now()->startOfMonth()->format('d-m-Y')}}</span> /
                        <span>{{Carbon\Carbon::now()->EndOfMonth()->format('d-m-Y')}}</span>
                    </div>
                    <div class="col-md-3">
                        <h1>Salaris</h1>
                        <span>€ {{$user->payrollThisMonth() * 0.06 }}</span>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Uren log
                </div>
                <div class="panel-body">

                    <div class="text-center">
                        <label class="label label-success" style="background: #7A92A3;">Pauze</label>
                        <label class="label label-success" style="background: #0B62A4;">werk</label>
                        <div id="bar-chart"></div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-md-6">
            @component('components.table', ['title' => 'Clocked'])
                @slot('btn')
                    <a href="{{route('user.create')}}" class="btn btn-success btn-xs pull-right">Toevoegen</a>
                @endslot

                @slot('head')
                    <th>worked <small>(min)</small></th>
                    <th>started_at</th>
                    <th>stopped_at</th>
                    <th>options</th>
                @endslot

                @slot('body')
                    @foreach($user->clocked as $clocked)
                        <tr>
                            <td>{{$clocked->worked_min}}</td>
                            <td>{{$clocked->started_at}}</td>
                            <td>{{$clocked->stopped_at}}</td>
                            <td>
                                <a href="{{route('user.edit', $user->id)}}" class="btn btn-warning btn-xs">edit</a>
                            </td>
                        </tr>
                    @endforeach
                @endslot
            @endcomponent
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Gegevens
                </div>
                <div class="panel-body">
                    {!! $user !!}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Passen
                </div>
                <div class="panel-body">

                    <label>list of active cards</label>
                    <ul class="list-group">
                        @foreach($user->cards as $card)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{$card->value}}
                                <a href="{{route('card.edit', $card->id)}}" class="btn btn-warning btn-xs pull-right">edit</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="panel panel-default">
                        <div class="panel-body">

                            {!! Form::open(['route' => ['card.update'], 'method' => 'patch']) !!}

                            <div class="form-group {{ $errors->has('id') ? 'has-error' : ''}}">
                                {!! Form::label('card', 'Add Card') !!}
                                {!! Form::select('id', $cards->pluck('value', 'id'), null, ['class' => 'form-control', 'placeholder' => '-- select --']) !!}
                                {!! Form::hidden('user_id', $user->id) !!}
                                <small id="emailHelp" class="form-text text-muted">
                                    Bind this card to the user.
                                </small>
                                @include('components.input-error-msg', ['name' => 'id'])
                            </div>

                            {!! Form::submit('Add', ['class' => 'btn']) !!}

                            {!! Form::close() !!}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@push('js')
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
            height: 200px;
            background: #3F51B5;
        }
    </style>
@endpush
