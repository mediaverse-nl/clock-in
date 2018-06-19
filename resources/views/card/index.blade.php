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
                        <a href="{{route('card.edit', $card->id)}}" class="btn btn-default btn-xs">edit</a>
                        <a href="{{route('card.show', $card->id)}}" class="btn btn-default btn-xs">show</a>
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent

@endsection
