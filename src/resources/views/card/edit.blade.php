@extends('layouts.app')

@section('content')

    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Card
                <div class="pull-right">
                    @if($card->user_id == null)
                        <a href="#"
                           class="btn btn-xs btn-danger"
                           orm="delete-{{$card->id}}"
                           onclick="if(confirm('Are you sure you want to delete this item?')){$('#delete-{{$card->id}}').submit();};">delete</a>

                        {{Form::open([
                            'method'  => 'DELETE',
                            'route' =>
                                ['card.destroy', $card->id],
                            'id' => 'delete-'.$card->id,
                            'class' => 'hidden'
                        ])}}

                        {{Form::close()}}
                    @else
                        <a href="#" class="btn btn-danger disabled btn-xs">delete</a>
                    @endif
                </div>

            </div>
            <div class="panel-body">
                {!! Form::model($card, ['route' => ['card.update', $card->id], 'method' => 'patch']) !!}

                    <div class="form-group">
                        {!! Form::label('value', 'Card Id') !!}
                        {!! Form::text('value', $card->value, ['class' => 'form-control', 'disabled']) !!}
                        <small id="emailHelp" class="form-text text-muted">
                            Card Id cant be changed clock in with a new card to register it.
                        </small>
                    </div>

                    <div class="form-group">
                        {!! Form::label('created_at', 'Registered at') !!}
                        {!! Form::text('created_at', null, ['class' => 'form-control', 'disabled']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('user_id', 'User') !!}
                        {!! Form::select('user_id', $user->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => '-- select --']) !!}
                        <small id="emailHelp" class="form-text text-muted">
                            Bind this card to an user.
                        </small>
                    </div>

                    {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
                    <a href="{{route('card.index')}}" class="btn btn-primary">back</a>
                {!! Form::close() !!}

            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>

    </script>
@endpush

@push('css')
    <style>

    </style>
@endpush
