@extends('layouts.app')

@section('content')

    <div class="col-md-8">
        @component('components.table', ['title' => 'Clocked'])
            @slot('btn')
                {{--<a href="{{route('clocked.create')}}" class="btn btn-success btn-xs pull-right">                                                           <i class="fa fa-plus fa-fw"></i>--}}
                {{--</a>--}}
            @endslot

            @slot('head')
                <th>worked <small>(from)</small></th>
                <th>worked <small>(to)</small></th>
                <th>worked <small>(min)</small></th>
                <th>user</th>
                <th>clocked in</th>
                <th class="no-sort">options</th>
            @endslot

            @slot('body')
                @foreach($clocks as $clock)
                    <tr>
                        <td>{{$clock->started_at}}</td>
                        <td>{{$clock->stopped_at}}</td>
                        <td>{{$clock->worked_min}}</td>
                        <td>{{$clock->user->name}}</td>
                        <td>{{$clock->active ? 'true' : 'false'}}</td>
                        <td>
                            @component('components.dropdown-btn')
                                <li>
                                    <a href="{{route('clocked.edit', $clock->id)}}">
                                        <i class="fa fa-edit fa-fw"></i>
                                        edit
                                    </a>
                                </li>
                                <li class="{{$clock->active == 1 ? : 'disabled'}}">
                                    @if($clock->active == 1)
                                        <a href="#"
                                           class="btn btn-xs btn-danger"
                                           orm="delete-{{$clock->id}}"
                                           onclick="if(confirm('Weet je zeker dat je dit wilt doen?')){$('#del-{{$clock->id}}').submit();};">
                                            <i class="fa fa-stop-circle fa-fw"></i> stop
                                        </a>
                                        {{Form::open(['method'  => 'patch', 'route' => ['clocked.stopTimer', $clock->id], 'id' => 'del-'.$clock->id])}}

                                        {{Form::close()}}
                                    @else
                                        <a href="#" class="disabled"><i class="fa fa-stop-circle fa-fw"></i> stop</a>
                                    @endif
                                </li>
                            @endcomponent
                            {{--                        <a href="{{route('clocked.edit', $clock->id)}}" class="btn btn-warning btn-xs">edit</a>--}}
                            {{--                        <a href="{{route('clocked.show', $clock->id)}}" class="btn btn-success btn-xs">show</a>--}}
                        </td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent

    </div>

@endsection
