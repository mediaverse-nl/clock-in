@extends('layouts.app')

@section('content')

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                {{--Standaard beschikbaarheid--}}
                {{--<a href="" class="btn btn-default pull-right">dsads</a>--}}
            {{--</div>--}}
            {{--<div style="height: auto">--}}
                {!! $render->calendar() !!}
            </div>

        </div>
    </div>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">

                {!! Form::open(['route' => ['super.settings.update', 1], 'method' => 'PATCH']) !!}

                    <div class="row">
                        <div class="col-md-2">
                            <br>
                            {!! Form::label('accountant_email', 'dinsdag', ['class' => 'pull-right']) !!}
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('accountant_email', 'accountant_email') !!}
                                {!! Form::text('accountant_email', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('accountant_email', 'accountant_email') !!}
                                {!! Form::text('accountant_email', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('accountant_email', 'accountant_email') !!}
                                {!! Form::text('accountant_email', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('accountant_email', 'accountant_email') !!}
                                {!! Form::text('accountant_email', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>


    <div class="col-md-12">
        @component('components.table', ['title' => 'Business'])
            @slot('btn')
                <a href="{{route('super.business.create')}}" class="btn btn-success btn-xs pull-right">
                    <i class="fa fa-plus fa-fw"></i>
                </a>
            @endslot

            @slot('head')
                <th>id</th>
                <th>name</th>
                {{--<th>x</th>--}}
                <th class="no-sort">options</th>
            @endslot

            @slot('body')
                {{--@foreach($business as $buss)--}}
                    {{--<tr>--}}
                        {{--<td>{{$buss->id}} <span class="hidden">{{$buss}}</span></td>--}}
                        {{--<td>{{$buss->name}}</td>--}}
                        {{--<td></td>--}}
                        {{--<td>--}}
                            {{--@component('components.dropdown-btn')--}}
                                {{--<li>--}}
                                    {{--<a href="{{route('super.business.edit', $buss->id)}}">--}}
                                        {{--<i class="fa fa-edit fa-fw"></i>--}}
                                        {{--edit--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endcomponent--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
            @endslot
        @endcomponent
    </div>

@endsection

@push('css')
    <style>

        .fc-day-grid-container{
            height: auto !important;
        }
        #calendar {
            width: 600px;
            margin: 0 auto;
        }
        .fc-time-grid-container{
            height: 100% !important;
        }
    </style>
@endpush

@push('js')
    {!! $render->script() !!}
@endpush