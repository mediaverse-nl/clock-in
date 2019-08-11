@extends('layouts.super-admin')

@section('content')
    {!! Breadcrumbs::render('super.location.edit', $location) !!}

    <div class="col-md-12">
        <div class="row">
            @component('components.tab', ['tabs' => [
                'location','whitelist', 'devices'
            ]])
                @slot('location')
                     @component('components.panel', ['title' => 'location'])
                        @slot('body')
                            {!! Form::model($location, ['route' => ['super.location.update', $location->id], 'method' => 'PATCH']) !!}
                            {{--{!! $business !!}--}}
                            <div class="form-group">
                                {!! Form::label('address', 'address') !!}
                                {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('address_nr', 'address_nr') !!}
                                {!! Form::text('address_nr', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('postal_code', 'postal_code') !!}
                                {!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('place', 'place') !!}
                                {!! Form::text('place', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('country', 'country') !!}
                                {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                            </div>

                            {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}


                            {!! Form::close() !!}
                        @endslot
                    @endcomponent
                @endslot
                @slot('whitelist')
                    @component('components.table', ['title' => 'whitelist'])
                        @slot('btn')
                            <a href="{{route('super.location.create', $location->id)}}" class="btn btn-success btn-xs pull-right">
                                <i class="fa fa-plus fa-fw"></i>
                            </a>
                        @endslot

                        @slot('head')
                             <th>ip_address</th>
                            <th class="no-sort">options</th>
                        @endslot

                        @slot('body')
                            @foreach($location->whitelist as $w)
                                <tr>
                                     <td>{{$w->ip_address}}</td>
                                    <td>
                                        @component('components.dropdown-btn')
                                            <li>
                                                <a href="{{route('super.location.edit', $w->id)}}">
                                                    <i class="fa fa-edit fa-fw"></i>
                                                    edit
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{route('super.location.destroy', $w->id)}}">
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

                @slot('devices')
                    @component('components.table', ['title' => 'devices'])
                        @slot('btn')
                            <a href="{{route('super.location.create', $location->id)}}" class="btn btn-success btn-xs pull-right">
                                <i class="fa fa-plus fa-fw"></i>
                            </a>
                        @endslot

                        @slot('head')
                            <th>version</th>
                            <th>mac_address</th>
                            <th>serial_nr</th>
                            <th>created_at</th>
                            <th class="no-sort">options</th>
                        @endslot

                        @slot('body')
                            @foreach($location->devices as $d)
                                <tr>
                                    <td>{{$d->version}}</td>
                                    <td>{{$d->mac_address}}</td>
                                    <td>{{$d->serial_nr}}</td>
                                    <td>{{$d->created_at}}</td>
                                    <td>
                                        @component('components.dropdown-btn')
                                            <li>
                                                <a href="{{route('super.location.edit', $d->id)}}">
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
            @endcomponent
        </div>
    </div>
@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script>

    </script>
@endpush