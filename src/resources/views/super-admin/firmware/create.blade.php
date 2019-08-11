@extends('layouts.super-admin')

@section('content')

{{--    {!! Breadcrumbs::render('super.business.edit', $business) !!}--}}

    <div class="col-md-12">
        <div class="row">
            {{--<div class="col-xs-12 col-sm-9 col-md-9 col-xl-6">--}}
            @component('components.panel', ['title' => 'nieuwe firmware'])
                @slot('body')
                    {!! Form::open(['route' => ['super.firmware.store'], 'method' => 'POST', 'files' => true]) !!}
                    {{--{!! $business !!}--}}
                    <div class="form-group">
                        {!! Form::label('app_name', 'app_name') !!}
                        {!! Form::text('app_name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('app_version', 'app_version') !!}
                        {!! Form::text('app_version', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('path', 'path') !!}
                        {!! Form::file('path', ['accept' => '.bin', 'class' => 'form-control']) !!}
                     </div>
                    <div class="form-group">
                        {!! Form::label('description', 'description') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => '', 'rows' => 3]) !!}
                     </div>

                    {!! Form::submit('Opslaan', ['class' => 'btn btn-success']) !!}

                    <a href="{{route('super.firmware.index')}}" class="btn btn-primary">back</a>

                    {!! Form::close() !!}
                @endslot
            @endcomponent

            {{--</div>--}}

        </div>
    </div>
@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush