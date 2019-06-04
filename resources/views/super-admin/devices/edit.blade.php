@extends('layouts.super-admin')

@section('content')

    {!! Breadcrumbs::render('super.business.edit', $business) !!}

    <div class="col-md-12">
        <div class="row">
            <div class="col-xs-12 col-sm-9 col-md-9 col-xl-6">

                @component('components.tab', ['tabs' => [
                    'business', 'packages', 'locations', 'users', 'settings', 'functions'
                ]])
                    @slot('business')
                        @component('components.panel', ['title' => 'business aanpassen'])
                            @slot('body')
                                {!! Form::model($business, ['route' => ['super.business.update', $business->id], 'method' => 'PATCH']) !!}
                                {{--{!! $business !!}--}}
                                <div class="form-group">
                                    {!! Form::label('name', 'name') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('coc_nr', 'coc_nr') !!}
                                    {!! Form::text('coc_nr', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('vat_nr', 'vat_nr') !!}
                                    {!! Form::text('vat_nr', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('bank_name', 'bank_name') !!}
                                    {!! Form::text('bank_name', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('bank_iban', 'bank_iban') !!}
                                    {!! Form::text('bank_iban', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('address', 'address') !!}
                                    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('address_nr', 'address_nr') !!}
                                    {!! Form::text('address_nr', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('postal_code', 'postal_code') !!}
                                    {!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('place', 'place') !!}
                                    {!! Form::text('place', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('country', 'country') !!}
                                    {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('created_at', 'created_at') !!}
                                    {!! Form::text('created_at', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('updated_at', 'updated_at') !!}
                                    {!! Form::text('updated_at', null, ['class' => 'form-control', 'placeholder' => 'select a device']) !!}
                                </div>

                                {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                                {{--<a href="{{route('super.business.index')}}" class="btn btn-primary">back</a>--}}

                                {!! Form::close() !!}
                            @endslot
                        @endcomponent
                    @endslot
                    @slot('packages')
                        @component('components.panel', ['title' => 'packages'])
                            @slot('body')
                                {!! Form::model($business->package, ['route' => ['super.business.update', $business->id], 'method' => 'PATCH']) !!}
                                {{--{!! $business !!}--}}
                                <div class="form-group">
                                    {!! Form::label('staff_members', 'staff_members') !!}
                                    {!! Form::text('staff_members', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('devices', 'devices') !!}
                                    {!! Form::text('devices', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('price', 'price') !!}
                                    {!! Form::text('price', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('subscription', 'subscription') !!}
                                    {!! Form::text('subscription', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('clocks', 'clocks') !!}
                                    {!! Form::text('clocks', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>

                                {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}


                                {!! Form::close() !!}
                            @endslot
                        @endcomponent
                    @endslot
                    @slot('locations')
                        @component('components.table', ['title' => 'locations'])
                            @slot('btn')
                                <a href="{{route('super.location.create', $business->id)}}" class="btn btn-success btn-xs pull-right">
                                    <i class="fa fa-plus fa-fw"></i>
                                </a>
                            @endslot

                            @slot('head')
                                <th>address</th>
                                <th>postal_code</th>
                                <th class="no-sort">options</th>
                            @endslot

                            @slot('body')
                                @foreach($business->locations as $buss)
                                    <tr>
                                        <td>{{$buss->address}}</td>
                                        <td>{{$buss->postal_code}}</td>
                                        <td>
                                            @component('components.dropdown-btn')
                                                <li>
                                                    <a href="{{route('super.location.edit', $buss->id)}}">
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
                    @endslot
                    @slot('users')
                        @component('components.table', ['title' => 'users'])
                            @slot('head')
                                <th>name</th>
                                <th>clock_in_code</th>
                                <th class="no-sort">options</th>
                            @endslot

                            @slot('body')
                                @foreach($business->users as $u)
                                    <tr>
                                        <td>{{$u->name}}</td>
                                        <td>{{$u->clock_in_code}}</td>
                                        <td>
                                            @component('components.dropdown-btn')
                                                <li>
                                                    <a href="{{route('super.business.edit', $u->id)}}">
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
                    @endslot
                    @slot('functions')
                        @component('components.table', ['title' => 'functions'])
                            @slot('head')
                                 <th>function</th>
                                <th class="no-sort">options</th>
                            @endslot

                            @slot('body')
                                @foreach($business->functions as $f)
                                    <tr>
                                         <td>{{$f->value}}</td>
                                        <td>
                                            @component('components.dropdown-btn')
                                                <li>
                                                    <a href="{{route('super.business.edit', $f->id)}}">
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
                    @endslot
                    @slot('settings')
                        @component('components.panel', ['title' => 'settings'])
                            @slot('body')
                                {!! Form::model($business->settings, ['route' => ['super.business.update', $business->id], 'method' => 'PATCH']) !!}
                                 <div class="form-group">
                                    {!! Form::label('accountant_email', 'accountant_email') !!}
                                    {!! Form::text('accountant_email', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('manager_email', 'manager_email') !!}
                                    {!! Form::text('manager_email', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('user_unit_price', 'user_unit_price') !!}
                                    {!! Form::text('user_unit_price', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('device_unit_price', 'device_unit_price') !!}
                                    {!! Form::text('device_unit_price', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                                </div>

                                {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                                {!! Form::close() !!}
                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent

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