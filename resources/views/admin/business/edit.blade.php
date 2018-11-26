@extends('layouts.app')

@section('content')

    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                settings
            </div>
            <div class="panel-body">
                {!! Form::model($business->settings, ['route' => ['super.settings.update', $business->settings->id], 'method' => 'PATCH']) !!}
                {!! Form::hidden('business_id', null, ['class' => 'form-control']) !!}

                    <div class="form-group">
                        {!! Form::label('accountant_email', 'accountant_email') !!}
                        {!! Form::text('accountant_email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('manager_email', 'manager_email') !!}
                        {!! Form::text('manager_email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('user_unit_price', 'user_unit_price') !!}
                        {!! Form::text('user_unit_price', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('device_unit_price', 'device_unit_price') !!}
                        {!! Form::text('device_unit_price', null, ['class' => 'form-control']) !!}
                    </div>
                    {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                package
            </div>
            <div class="panel-body">
                {!! Form::model($business->package, ['route' => ['super.package.update', $business->package->id], 'method' => 'PATCH']) !!}
                {!! Form::hidden('business_id', null, ['class' => 'form-control']) !!}

                <div class="form-group">
                    {!! Form::label('staff_members', 'staff_members') !!}
                    {!! Form::text('staff_members', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('device', 'device') !!}
                    {!! Form::text('device', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('price', 'price') !!}
                    {!! Form::text('price', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('subscription', 'subscription') !!}
                    {!! Form::text('subscription', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('clocks', 'clocks') !!}
                    {!! Form::text('clocks', null, ['class' => 'form-control']) !!}
                </div>
                {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        @component('components.table', ['title' => 'Locations'])
            @slot('btn')
                <a href="{{route('super.location.create', $business->id)}}" class="btn btn-success btn-xs pull-right">
                    <i class="fa fa-plus fa-fw"></i>
                </a>
            @endslot

            @slot('head')
                <th>id</th>
                <th>address</th>
                <th>devices</th>
                <th class="no-sort">options</th>
            @endslot

            @slot('body')
                @foreach($business->locations as $location)
                    <tr>
                        <td>{{$location->id}} <span class="hidden">{{$location}}</span></td>
                        <td>{{$location->postal_code}}, {{$location->address_nr }}</td>
                        <td>{!! $location->devices->count() !!}</td>
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


    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        @component('components.table', ['title' => 'Users'])
            @slot('btn')
                <a href="{{route('super.user.create', $business->id)}}" class="btn btn-success btn-xs pull-right">
                    <i class="fa fa-plus fa-fw"></i>
                </a>
            @endslot

            @slot('head')
                <th>id</th>
                <th>name</th>
                <th>role(s)</th>
                <th>function(s)</th>
                <th class="no-sort">options</th>
            @endslot

            @slot('body')
                @foreach($business->users as $user)
                    <tr>
                        <td>{{$user->id}} <span class="hidden">{{$user}}</span></td>
                        <td>{{$user->name}}</td>
                        <td>
                            @foreach($user->userRoles as $role)
                                <span class="badge badge-default">
                                    {{$role->role->value}}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            @foreach($user->userFunctions as $function)
                                <span class="badge badge-default">
                                    {{$function->functions->value}}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            @component('components.dropdown-btn')
                                <li>
                                    <a href="{{route('super.user.edit', $location->id)}}">
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
        @component('components.table', ['title' => 'Functions'])
            @slot('btn')
                <a href="{{route('super.function.create', $business->id)}}" class="btn btn-success btn-xs pull-right">
                    <i class="fa fa-plus fa-fw"></i>
                </a>
            @endslot

            @slot('head')
                <th>function</th>
                <th class="no-sort">options</th>
            @endslot

            @slot('body')
                @foreach($business->functions as $function)
                    <tr>
                        <td>{{$function->value}}</td>
                        <td>
                            @component('components.dropdown-btn')
                                <li>
                                    <a href="{{route('super.function.edit', $function->id)}}">
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
        <div class="panel panel-default">
            <div class="panel-heading">
                business
            </div>
            <div class="panel-body">
                {!! Form::model($business, ['route' => ['super.business.update', $business->id], 'method' => 'PATCH']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('coc_nr', 'coc_nr') !!}
                    {!! Form::text('coc_nr', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('vat_nr', 'vat_nr') !!}
                    {!! Form::text('vat_nr', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bank_name', 'bank_name') !!}
                    {!! Form::text('bank_name', null, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('bank_iban', 'bank_iban') !!}
                    {!! Form::text('bank_iban', null, ['class' => 'form-control']) !!}
                </div>
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
                    {!! Form::label('country ', 'country') !!}
                    {!! Form::text('country', null, ['class' => 'form-control']) !!}
                </div>

                {{--todo functions moeten aangemaakt kunnen worden voor een bedrijf--}}
{{--                {!! Form::text('country', null, ['class' => 'form-control']) !!}--}}

                {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush