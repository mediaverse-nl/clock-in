@extends('layouts.super-admin')

@section('content')
    <div class="col-md-12">
        <div class="row">

{{--            {!! Breadcrumbs::render('super.device.index') !!}--}}

            @component('components.table', ['title' => 'Business'])
                @slot('btn')
                    <a href="{{route('super.business.create')}}" class="btn btn-success btn-xs pull-right">
                        <i class="fa fa-plus fa-fw"></i>
                    </a>
                @endslot

                @slot('head')
                    <th>id</th>
                    <th>location</th>
                    <th>serial</th>
                    <th>version</th>
                    <th class="no-sort">options</th>
                @endslot

                @slot('body')
                    @foreach($devices as $d)
                        <tr>
                            <td>{{$d->id}} <span class="hidden">{{$d}}</span></td>
                            <td>{!! $d->location != null ? $d->location->fulAddress : '<b>geen locatie</b>' !!}</td>
                            <td>{{$d->serial_nr}}</td>
                            <td>{{$d->version}}</td>
                            <td>
                                @component('components.dropdown-btn')
                                    <li>
                                        <a href="{{route('super.business.edit', $d->id)}}">
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
@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush