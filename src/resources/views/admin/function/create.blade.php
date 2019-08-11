@extends('layouts.app')

@section('content')



    <div class="panel panel-default">
        <div class="panel-heading">
            new function
        </div>
        <div class="panel-body">
            {!! Form::open(['route' => ['super.function.store'], 'method' => 'POST']) !!}
                {!! Form::hidden('business_id', $business_id, ['class' => 'form-control']) !!}

                <div class="form-group">
                    {!! Form::label('value', 'value') !!}
                    {!! Form::text('value', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                <a href="{{route('super.business.edit', $business_id)}}" class="btn btn-primary">back</a>

            {!! Form::close() !!}
        </div>
    </div>


@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush