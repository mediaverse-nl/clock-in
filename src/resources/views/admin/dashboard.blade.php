@extends('layouts.admin')

@section('content')

    {{--@php--}}
        {{--use GuzzleHttp\Client;--}}

        {{--$client = new Client();--}}
        {{--$api_response = $client--}}
            {{--->request('GET', 'http://weerlive.nl/api/json-data-10min.php?key=74e3b11987&locatie=Eindhoven')--}}
            {{--->getBody();--}}

        {{--$weather = (object) json_decode((string) $api_response, false);--}}
        {{--$weatherResponse = $weather->liveweer[0];--}}
        {{--//dd($weatherResponse->plaats);--}}
    {{--@endphp--}}

    <div class="col-md-12">
        <div class="row">

{{--            {!! $weatherResponse->temp !!}--}}

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        rooster
                    </div>
                    <div class="panel-body">
                        asdasd
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        time tracker
                    </div>
                    <div class="panel-body">
                        asdasd
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        time tracker
                    </div>
                    <div class="panel-body">
                        asdasd
                    </div>
                </div>
            </div>

            asdasdasd

            http://weerlive.nl/api/json-data-10min.php?key=74e3b11987&locatie=Eindhoven

        </div>
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