@extends('layouts.super-admin')

@section('content')

    {!! Breadcrumbs::render('super.dashboard') !!}

    <div class="col-md-12">
        <div class="row">
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
                    @foreach($business as $buss)
                        <tr>
                            <td>{{$buss->id}} <span class="hidden">{{$buss}}</span></td>
                            <td>{{$buss->name}}</td>
                            {{--<td></td>--}}
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
@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush