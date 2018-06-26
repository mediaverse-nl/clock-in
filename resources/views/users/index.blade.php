@extends('layouts.app')

@section('content')

    @component('components.table', ['title' => 'Users'])
        @slot('btn')
            <a href="{{route('user.create')}}" class="btn btn-success btn-xs pull-right">Aanmaken</a>
        @endslot

        @slot('head')
            <th>id</th>
            <th>name</th>
            <th>email</th>
            <th>worked</th>
            <th>clock in</th>
            <th>options</th>
        @endslot

        @slot('body')
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>h{{number_format($user->payrollThisMonth() / 60)}}</td>
                    <td>{{$user->isClockedIn()}}</td>
                    <td>
                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-warning btn-xs">edit</a>
                        <a href="{{route('user.show', $user->id)}}" class="btn btn-success btn-xs">show</a>
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent

@endsection
