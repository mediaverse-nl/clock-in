@extends('layouts.app')

@section('content')

    <div class="col-md-8">

        @component('components.table', ['title' => 'Cards'])
            @slot('head')
                <th>id</th>
                <th>card</th>
                <th>gebruiker</th>
                <th class="no-sort">options</th>
            @endslot

            @slot('body')
                @foreach($cards as $card)
                    <tr>
                        <td>{{$card->id}}</td>
                        <td>{{$card->value}}</td>
                        <td>{{$card->user_id !== null ? $card->user->name : 'geen'}}</td>
                        <td>
                            @component('components.dropdown-btn')
                                <li>
                                    <a href="{{route('card.edit', $card->id)}}">
                                        <i class="fa fa-edit fa-fw"></i>
                                        edit
                                    </a>
                                </li>
                                <li class="{{$card->user_id == null ? : 'disabled'}}">
                                    @if($card->user_id == null)
                                        <a form="delete-{{$card->id}}"
                                           onclick="if(confirm('Press a button!')){$('#delete-{{$card->id}}').submit();};">
                                            <i class="fa fa-trash fa-fw"></i>
                                            delete
                                        </a>
                                        {{Form::open([
                                            'method'  => 'DELETE',
                                            'route' =>
                                                ['card.destroy', $card->id],
                                            'id' => 'delete-'.$card->id,
                                            'class' => 'hidden'
                                        ])}}
                                        {{Form::close()}}
                                    @else
                                        <a href="#" class="disabled"><i class="fa fa-trash fa-fw"></i> delete</a>
                                    @endif
                                </li>
                            @endcomponent
                        </td>
                    </tr>
                @endforeach
            @endslot
        @endcomponent
    </div>


@endsection
