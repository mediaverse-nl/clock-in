@extends('layouts.app')

@section('content')

    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                settings
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-6 col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                package
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
        @component('components.table', ['title' => 'Locations'])
            @slot('btn')
                <a href="{{route('user.create')}}" class="btn btn-success btn-xs pull-right">
                    <i class="fa fa-plus fa-fw"></i>
                </a>
            @endslot

            @slot('head')
                {{--<th>id</th>--}}
                <th>address</th>
                {{--<th>x</th>--}}
                <th class="no-sort">options</th>
            @endslot

            @slot('body')
                @foreach($business->locations as $location)
                    <tr>
{{--                        <td>{{$location->id}} <span class="hidden">{{$location}}</span></td>--}}
                        <td>{{$location->postal_code}}, {{$location->address_nr }}</td>
                        {{--<td></td>--}}
                        <td>
                            @component('components.dropdown-btn')
                                <li>
                                    <a href="{{route('super.location.index', $location->id)}}">
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