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

    <div class="col-md-12">
        <div class="row">
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
                @component('components.table', ['title' => 'Clocked'])
                    @slot('btn')
                        <a href="{{route('user.create')}}" class="btn btn-success btn-xs pull-right">
                            <i class="fa fa-plus fa-fw"></i>
                        </a>
                    @endslot

                    @slot('head')
                        <th>started_at</th>
                        <th>stopped_at</th>
                        <th>worked <small>(min)</small></th>
                        <th class="no-sort">options</th>
                    @endslot

                    @slot('body')
                        @foreach($user->clocked as $clocked)
                            <tr>
                                <td>{{$clocked->started_at}}</td>
                                <td>{{$clocked->stopped_at}}</td>
                                <td>{{$clocked->worked_min}}</td>
                                <td>
                                    @component('components.dropdown-btn')
                                        <li>
                                            <a href="{{route('clocked.edit', $clocked->id)}}">
                                                <i class="fa fa-edit fa-fw"></i>
                                                edit
                                            </a>
                                        </li>
                                        <li class="{{$clocked->active == 1 ? : 'disabled'}}">
                                            @if($clocked->active == 1)
                                                <a href="#"
                                                   orm="delete-{{$clocked->id}}"
                                                   onclick="if(confirm('Weet je zeker dat je dit wilt doen?')){$('#del-{{$clocked->id}}').submit();};">
                                                    <i class="fa fa-stop-circle fa-fw"></i> stop
                                                </a>
                                                {{Form::open(['method'  => 'patch', 'route' => ['clocked.stopTimer', $clocked->id], 'id' => 'del-'.$clocked->id])}}

                                                {{Form::close()}}
                                            @else
                                                <a href="#" class="disabled"><i class="fa fa-stop-circle fa-fw"></i> stop</a>
                                            @endif
                                        </li>
                                    @endcomponent


                                </td>
                            </tr>
                        @endforeach
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>

    <div class="col-md-12">

        <div class="row">

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Gegevens
                    </div>
                    <div class="panel-body">

                        {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'patch']) !!}

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('name', 'User Name') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'disabled']) !!}
                            @include('components.input-error-msg', ['name' => 'name'])
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                            {!! Form::label('email', 'E-Mail Address') !!}
                            {!! Form::email('email', null, ['class' => 'form-control', 'disabled']) !!}
                            @include('components.input-error-msg', ['name' => 'email'])
                        </div>

                        <div class="form-group">
                            @foreach($roles as $role)
                                {!! Form::checkbox('roles[]',
                                    $role->id,
                                    in_array($role->id, $user->userRoles()->pluck('role_id')->toArray()),
                                    ['id' => $role->value]) !!}
                                {!! Form::label($role->value, $role->value) !!}
                            @endforeach

                            @include('components.input-error-msg', ['name' => 'email'])
                        </div>

                        {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}


                        {!! Form::close() !!}

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
                                    {{$card->created_at}}
                                    <a href="{{route('card.edit', $card->id)}}" class="btn btn-warning btn-xs pull-right">                                                <i class="fa fa-edit fa-fw"></i>
                                    </a>
                                </li>
                            @endforeach
                            @if($user->cards->count() == 0)
                                Geen kaart gevond.
                            @endif
                        </ul>

                        <div class="panel panel-default">
                            <div class="panel-body">

                                {!! Form::open(['route' => ['user.update.card'], 'method' => 'patch']) !!}

                                <div class="form-group {{ $errors->has('card') ? 'has-error' : ''}}">
                                    {!! Form::label('card', 'Kaart toevoegen') !!}
                                    {!! Form::select('card', $cards->pluck('created_at', 'id'), null, ['class' => 'form-control', 'placeholder' => '-- select --']) !!}
                                    {!! Form::hidden('user_id', $user->id) !!}
                                    <small id="emailHelp" class="form-text text-muted">
                                        Bind een kaart aan de gebruiker.
                                    </small>
                                    @include('components.input-error-msg', ['name' => 'card'])
                                </div>

                                {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                                {!! Form::close() !!}

                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        ----
                    </div>
                    <div class="panel-body">



                    </div>
                </div>
            </div>


            {{--<div class="col-md-6">--}}
            {{--@component('components.table', ['title' => 'Uren log'])--}}

            {{--@slot('head')--}}
            {{--<th>start</th>--}}
            {{--<th>stop</th>--}}
            {{--<th>from</th>--}}
            {{--<th>to</th>--}}
            {{--@endslot--}}

            {{--@slot('body')--}}
            {{--@foreach($calendar as $cal)--}}
            {{--<tr>--}}
            {{--<td>{{$cal->start->format('Y-m-d H:i')}}</td>--}}
            {{--<td>{{$cal->stop->format('Y-m-d H:i')}}</td>--}}
            {{--<td>--}}
            {{--{{$cal->stop}}--}}
            {{--{{$cal->workedFrom()}}--}}
            {{--</td>--}}
            {{--<td>{{ Carbon\Carbon::parse($cal->workedTo())->format('Y-m-d H:i')}}</td>--}}
            {{--</tr>--}}
            {{--@endforeach--}}
            {{--@endslot--}}
            {{--@endcomponent--}}
            {{--</div>--}}

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
