@extends('layouts.app')

@section('content')

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                settings
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                package
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                locations
            </div>
            <div class="panel-body">
                {!! $business->locations()->get() !!}
                {{--@foreach($business->locations as $bus)--}}
                    {{--{!! $bus !!}--}}
                {{--@endforeach--}}
            </div>
        </div>
    </div>


    {{--<div class="col-md-8">--}}

        {{--@component('components.table', ['title' => 'Users'])--}}
            {{--@slot('btn')--}}
                {{--<a href="{{route('user.create')}}" class="btn btn-success btn-xs pull-right">--}}
                    {{--<i class="fa fa-plus fa-fw"></i>--}}
                {{--</a>--}}
            {{--@endslot--}}

            {{--@slot('head')--}}
                {{--<th>id</th>--}}
                {{--<th>name</th>--}}
                {{--<th>name</th>--}}
                {{--<th class="no-sort">options</th>--}}
            {{--@endslot--}}

            {{--@slot('body')--}}
                {{--@foreach($business as $buss)--}}
                    {{--<tr>--}}
                        {{--<td>{{$buss->id}}</td>--}}
                        {{--<td>{{$buss->name}}</td>--}}
{{--                        <td>{{$user}}</td>--}}
                        {{--<td>--}}
                            {{--@component('components.dropdown-btn')--}}
                                {{--<li>--}}
                                    {{--<a href="{{route('user.edit', $buss->id)}}">--}}
                                        {{--<i class="fa fa-edit fa-fw"></i>--}}
                                        {{--edit--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li>--}}
                                    {{--<a href="{{route('user.show', $buss->id)}}">--}}
                                        {{--<i class="fa fa-edit fa-fw"></i>--}}
                                        {{--watch--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endcomponent--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                {{--@endforeach--}}
            {{--@endslot--}}
        {{--@endcomponent--}}
    {{--</div>--}}
@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush