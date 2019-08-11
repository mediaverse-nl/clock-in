@extends('layouts.super-admin')

@section('content')
    <div class="col-md-12">
        <div class="row">
            @component('components.panel', ['title' => 'new location'])
                @slot('body')
                    {!! Form::open(['route' => ['super.location.store'], 'method' => 'POST']) !!}
                    {!! Form::hidden('business_id', $business_id) !!}
                    <div class="form-group">
                        {!! Form::label('address', 'address') !!}
                        {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('address_nr', 'address_nr') !!}
                        {!! Form::text('address_nr', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('postal_code', 'postal_code') !!}
                        {!! Form::text('postal_code', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('place', 'place') !!}
                        {!! Form::text('place', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('country', 'country') !!}
                        {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}


                    {!! Form::close() !!}
                @endslot
            @endcomponent
        </div>
    </div>
@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script>

    </script>
@endpush