@extends('layouts.super-admin')

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">

                @component('components.panel', ['title' => 'business aanpassen'])
                    @slot('btn')
                        <a href="{{route('super.business.create')}}" class="btn btn-success btn-xs pull-right">
                            <i class="fa fa-plus fa-fw"></i>
                        </a>
                    @endslot

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
            </div>

            <div class="col-md-4">
                 @component('components.panel', ['title' => 'package aanpassen'])
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

            </div>
            <div class="col-md-4">
                @component('components.table', ['title' => 'Locations'])
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
                                            <a href="{{route('super.business.edit', $buss->id)}}">
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

        </div>
    </div>
@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush