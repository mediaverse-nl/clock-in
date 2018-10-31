@extends('layouts.app')

@section('content')

    <div class="col-md-4">
        <a href="{{route('clocked.index')}}">
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
        <a href="{{route('clocked.index')}}">
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
    <style>
        #start-panel{
            background: #2ab27b; border: none;
        }
        #start-panel .fa,
        #start-panel p,
        #start-panel span {
            color: #ffffff;
        }
        #start-panel > .panel-body > div > .h1{
            vertical-align: bottom !important;
            display: inline-block;
            color: #fff;
            margin-top: auto;
            margin-bottom: auto;
        }
    </style>
@endpush

@push('js')

@endpush