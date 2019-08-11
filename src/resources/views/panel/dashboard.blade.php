@extends('layouts.app')

@section('content')

    <div class="col-md-4">
        <a href="{{route('super.business.index')}}">
            <div class="panel panel-default" id="start-panel">
                <div class="panel-body">
                    <i class="fa fa-user-clock fa-5x"></i>
                    <div class="pull-right">
                        <p class="text-right">Clocked In</p>
                        <span class="h1">
                             Business
                        </span>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-4">
        <a href="{{route('super.dashboard')}}">
            <div class="panel panel-default" id="start-panel">
                <div class="panel-body">
                    <i class="fa fa-user-clock fa-5x"></i>
                    <div class="pull-right">
                        <p class="text-right">Clocked In</p>
                        <span class="h1">
                             Tickets
                        </span>
                    </div>
                </div>
            </div>
        </a>
    </div>

@endsection

@push('css')

@endpush

@push('js')

@endpush