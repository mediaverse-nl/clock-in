@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Card
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
                            {!! Form::label('user_id', 'User') !!}
                            {!! Form::select('user_id', $user->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => '-- select --']) !!}
                            <small id="emailHelp" class="form-text text-muted">
                                Bind this card to an user.
                            </small>
                        </div>

                        {!! Form::submit('Update', ['class' => 'btn']) !!}

                    {!! Form::close() !!}

                </div>
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
