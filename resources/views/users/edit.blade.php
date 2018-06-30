@extends('layouts.app')

@section('content')
    @component('components.container-full-width')
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
    @endcomponent

    <div class="col-md-6">
        @component('components.table', ['title' => 'Uren log'])

            @slot('head')
                <th>start</th>
                <th>stop</th>
                <th>from</th>
                <th>to</th>
            @endslot

            @slot('body')
                @foreach($calendar as $cal)
                    <tr>
                        <td>{{$cal->start}}</td>
                        <td>{{$cal->stop}}</td>
                        <td>{{$cal->workedFrom()}}</td>
                        <td>{{$cal->workedTo()}}</td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent
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
                            <a href="{{route('clocked.edit', $user->id)}}" class="btn btn-warning btn-xs">edit</a>
                            @if($clocked->active == 1)
                                <a href="#"
                                   class="btn btn-xs btn-danger"
                                   orm="delete-{{$clocked->id}}"
                                   onclick="if(confirm('Press a button!')){$('#del-{{$clocked->id}}').submit();};">stop</a>
                                {{Form::open(['method'  => 'patch', 'route' => ['clocked.stopTimer', $clocked->id], 'id' => 'del-'.$clocked->id])}}
                                {{Form::close()}}
                            @else
                                <a href="#" class="btn btn-danger disabled btn-xs">stop</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    </div>

    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                Gegevens
            </div>
            <div class="panel-body">
                {!! $user !!}
            </div>
        </div>
    </div>

    <div class="col-md-3">
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
    </style>
@endpush
