@extends('layouts.app')

@section('content')

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Device(s)
            </div>
            <div class="panel-body">
                alle geregistered devices
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Whitelist
            </div>
            <div class="panel-body">
                alle ip adresse die gewhitelist moeten worden
            </div>
        </div>
    </div>

@endsection

@push('css')
    <style>

    </style>
@endpush

@push('js')

@endpush