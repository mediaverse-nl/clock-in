@extends('layouts.app')

@section('content')

    @component('components.table', ['title' => 'Users'])
        @slot('btn')
            <a href="{{route('user.create')}}" class="btn btn-success btn-xs pull-right">Aanmaken</a>
        @endslot

        @slot('head')
            <th>worked_min</th>
            {{--<th>name</th>--}}
            {{--<th>email</th>--}}
            <th>worked</th>
            <th>user</th>
            <th>clock in</th>
            <th>options</th>
        @endslot

        @slot('body')
            @foreach($clocks as $clock)
                <tr>
                    <td>{{$clock->worked_min}}</td>
                    <td>{{$clock->started_at}}</td>
                    <td>{{$clock->stopped_at}}</td>
                    <td>{{$clock->user->name}}</td>
                    <td>
                        <a href="{{route('clocked.edit', $clock->id)}}" class="btn btn-warning btn-xs">edit</a>
                        <a href="{{route('clocked.show', $clock->id)}}" class="btn btn-success btn-xs">show</a>
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent

@endsection
