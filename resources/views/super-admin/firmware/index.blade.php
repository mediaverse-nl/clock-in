@extends('layouts.super-admin')

@section('content')
    <div class="col-md-12">
        <div class="row">

{{--            {!! Breadcrumbs::render('super.device.index') !!}--}}

            @component('components.table', ['title' => 'Firmware'])
                @slot('btn')
                    <a href="{{route('super.firmware.create')}}" class="btn btn-success btn-xs pull-right">
                        <i class="fa fa-plus fa-fw"></i>
                    </a>
                @endslot

                @slot('head')
                    <th>id</th>
                    <th>app_name</th>
                    <th>app_version</th>
                    <th>path</th>
                    <th>description</th>
                    <th class="no-sort">options</th>
                @endslot

                @slot('body')
                    @foreach($firmware as $f)
                        <tr>
                            <td>{{$f->id}} <span class="hidden">{{$f}}</span></td>
{{--                            <td>{{$f != null ? $f->app_name : 'geen locatie'}}</td>--}}
                            <td>{{$f->app_name}}</td>
                            <td>{{$f->app_version}}</td>
                            <td>{{$f->path}}</td>
                            <td>{{$f->description}}</td>
                            <td>
                                @component('components.dropdown-btn')
                                    <li>
                                        <a href="{{route('super.firmware.edit', $f->id)}}">
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