@extends('layouts.app')

@section('content')

    @component('components.table', ['title' => 'Cards'])
        @slot('head')
            <th>id</th>
            <th>card</th>
            <th>gebruiker</th>
            <th>options</th>
        @endslot

        @slot('body')
            @foreach($cards as $card)
                <tr>
                    <td>{{$card->id}}</td>
                    <td>{{$card->value}}</td>
                    <td>{{$card->user_id !== null ? $card->user->name : 'geen'}}</td>
                    <td>
                        <a href="{{route('card.edit', $card->id)}}" class="btn btn-warning btn-xs">edit</a>
                        <a href="{{route('card.show', $card->id)}}" class="btn btn-success btn-xs">show</a>
                        @if($card->user_id == null)
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               orm="delete-{{$card->id}}"
                               onclick="if(confirm('Press a button!')){$('#delete-{{$card->id}}').submit();};">delete</a>

                            {{Form::open(['method'  => 'DELETE', 'route' => ['card.destroy', $card->id], 'id' => 'delete-'.$card->id, 'class' => 'hidden'])}}
                            {{Form::close()}}
                            {{--<a href="{{route('card.show', $card->id)}}" class="">delete</a>--}}
                        @else
                            <a href="#" class="btn btn-danger disabled btn-xs">delete</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent

@endsection
