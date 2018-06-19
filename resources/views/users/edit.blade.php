@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4">
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
                labels: ['Total Income', 'Total Outcome'],
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
