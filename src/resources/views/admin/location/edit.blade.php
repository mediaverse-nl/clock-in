@extends('layouts.app')

@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                edit location
            </div>
            <div class="panel-body">
                {!! Form::model($location, ['route' => ['super.location.edit', $location->id], 'method' => 'POST']) !!}

                    <div class="form-group">
                        {!! Form::label('address', 'address') !!}
                        {!! Form::text('address', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('address_nr', 'address_nr') !!}
                        {!! Form::text('address_nr', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('postal_code', 'postal_code') !!}
                        {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('place', 'place') !!}
                        {!! Form::text('place', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country', 'country') !!}
                        {!! Form::text('country', null, ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                    <a href="{{route('super.business.index')}}" class="btn btn-primary">back</a>

                {!! Form::close() !!}
            </div>
        </div>
    </div>


    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        @component('components.table', ['title' => 'Devices'])
            @slot('btn')
                <a href="{{route('super.device.create', $location->id)}}" class="btn btn-success btn-xs pull-right">
                    <i class="fa fa-plus fa-fw"></i>
                </a>
            @endslot

            @slot('head')
                <th>id</th>
                <th>version</th>
                <th>serial_nr</th>
                <th class="no-sort">options</th>
            @endslot

            @slot('body')
                @foreach($location->devices as $device)
                    <tr>
                        <td>{{$device->id}}</td>
                        <td>{{$device->version}}</td>
                        <td>{{$device->serial_nr}}</td>
                        <td>
                            @component('components.dropdown-btn')
                                <li>
                                    <a href="{{route('super.device.edit', $location->id)}}">
                                        <i class="fa fa-edit fa-fw"></i>
                                        edit
                                    </a>
                                </li>
                            @endcomponent
                        </td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        @component('components.table', ['title' => 'Whitelist'])
            @slot('btn')
                <a href="{{route('super.device.create', $location->id)}}" class="btn btn-success btn-xs pull-right">
                    <i class="fa fa-plus fa-fw"></i>
                </a>
            @endslot

            @slot('head')
                <th>id</th>
                <th>ip address</th>
                <th class="no-sort">options</th>
            @endslot

            @slot('body')
                @foreach($location->whitelist as $whitelist)
                    <tr>
                        <td>{{$whitelist->ip_address}}</td>
                        <td>
                            @component('components.dropdown-btn')
                                <li>
                                    <a href="{{route('super.location.edit', $location->id)}}">
                                        <i class="fa fa-edit fa-fw"></i>
                                        edit
                                    </a>
                                </li>
                            @endcomponent
                        </td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    </div>

@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush