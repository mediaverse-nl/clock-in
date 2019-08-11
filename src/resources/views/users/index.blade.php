@extends('layouts.app')

@section('content')

    <div class="col-md-8">

        @component('components.table', ['title' => 'Users'])
            @slot('btn')
                <a href="{{route('user.create')}}" class="btn btn-success btn-xs pull-right">
                    <i class="fa fa-plus fa-fw"></i>
                </a>
            @endslot

            @slot('head')
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>worked</th>
                <th>clock in</th>
                <th class="no-sort">options</th>
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
                            @component('components.dropdown-btn')
                                <li>
                                    <a href="{{route('user.edit', $user->id)}}">
                                        <i class="fa fa-edit fa-fw"></i>
                                        edit
                                    </a>
                                </li>
                                {{--<li class="{{$card->user_id == null ? : 'disabled'}}">--}}
                                    {{--@if($card->user_id == null)--}}
                                        {{--<a form="delete-{{$card->id}}"--}}
                                           {{--onclick="if(confirm('Press a button!')){$('#delete-{{$card->id}}').submit();};">--}}
                                            {{--<i class="fa fa-trash fa-fw"></i>--}}
                                            {{--delete--}}
                                        {{--</a>--}}
                                        {{--{{Form::open([--}}
                                            {{--'method'  => 'DELETE',--}}
                                            {{--'route' =>--}}
                                                {{--['card.destroy', $card->id],--}}
                                            {{--'id' => 'delete-'.$card->id,--}}
                                            {{--'class' => 'hidden'--}}
                                        {{--])}}--}}
                                        {{--{{Form::close()}}--}}
                                    {{--@else--}}
                                        {{--<a href="#" class="disabled"><i class="fa fa-trash fa-fw"></i> delete</a>--}}
                                    {{--@endif--}}
                                {{--</li>--}}
                            @endcomponent
                            {{--<a href="{{route('user.edit', $user->id)}}" class="btn btn-warning btn-xs">edit</a>--}}
                        </td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    </div>

@endsection
