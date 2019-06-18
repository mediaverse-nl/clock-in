@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <a href="{!! route('admin.team.index') !!}" class="active btn btn-primary">Personeel</a>
                <a href="{!! route('admin.team.roles') !!}" class="btn btn-primary">Roles</a>
{{--                <a href="{!! route('admin.team.cards') !!}" class="btn btn-primary">Cards</a>--}}
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group pull-right" role="group" aria-label="">
                            <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Voeg een gebruiker toe">
                                <i class="fas fa-plus"></i>
                            </a>
                            <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Groepsbericht maken">
                                <i class="fas fa-comment"></i>
                            </a>
                            <a class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Klok in codes">
                                <i class="fas fa-user-lock"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    {!! Form::model($user,['route' => ['admin.team.update', $user->id], 'method' => 'PATCH']) !!}

    <div class="col-md-6 col-lg-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                Gebruiker aanmelden
            </div>
            <div class="panel-body">

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                    {!! Form::label('name', 'Volledige Naam') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'name'])
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                    {!! Form::label('email', 'E-Mail Adres') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'email'])
                </div>

                <div class="form-group {{ $errors->has('date_of_birth') ? 'has-error' : ''}}">
                    {!! Form::label('date_of_birth', 'date_of_birth') !!}
                    {!! Form::date('date_of_birth', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'date_of_birth'])
                </div>

                <div class="form-group {{ $errors->has('hourly_rate') ? 'has-error' : ''}}">
                    {!! Form::label('hourly_rate', 'hourly_rate') !!}
                    {!! Form::number('hourly_rate', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'hourly_rate'])
                </div>

                <div class="form-group {{ $errors->has('contract_hours') ? 'has-error' : ''}}">
                    {!! Form::label('contract_hours', 'contract_hours') !!}
                    {!! Form::text('contract_hours', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'contract_hours'])
                </div>

                <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                    {!! Form::label('address', 'address') !!}
                    {!! Form::text('address', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'address'])
                </div>

                <div class="form-group {{ $errors->has('address_nr') ? 'has-error' : ''}}">
                    {!! Form::label('address_nr', 'address_nr') !!}
                    {!! Form::text('address_nr', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'address_nr'])
                </div>

                <div class="form-group {{ $errors->has('postal_code') ? 'has-error' : ''}}">
                    {!! Form::label('postal_code', 'postal_code') !!}
                    {!! Form::text('postal_code', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'postal_code'])
                </div>

                <div class="form-group {{ $errors->has('place') ? 'has-error' : ''}}">
                    {!! Form::label('place', 'place') !!}
                    {!! Form::text('place', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'place'])
                </div>

                <div class="form-group {{ $errors->has('place') ? 'has-error' : ''}}">
                    {!! Form::label('place', 'place') !!}
                    {!! Form::text('place', null, ['class' => 'form-control']) !!}
                    @include('components.input-error-msg', ['name' => 'place'])
                </div>

                <div class="form-group {{ $errors->has('function') ? 'has-error' : ''}}">
                    {!! Form::label('function', 'Functies') !!}
                    @foreach($user->business->functions as $function)
                        <div class="checkbox">
                            <label>
{{--                                {!! dd($user->userFunctions()->pluck('function_id')->toArray()) !!}--}}
                                {!! Form::checkbox('functions[]', $function->id, in_array($function->id, $user->userFunctions->pluck('function_id')->toArray()))!!}
                                {!! $function->value !!}
                            </label>
                        </div>
                    @endforeach
                </div>

                <br>

            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-8">
        {{--<div class="row">--}}

        <ul class="nav nav-tabs">
            @for($x = 1; $x <= 5; $x++)
                <li {!! $x == 1 ? 'class="active"' : null !!}>
                    <a data-toggle="tab" href="#week{!! $x !!}">Week {!! \Carbon\Carbon::now()->addWeeks($x)->weekOfYear !!}</a>
                </li>
            @endfor
        </ul>

        <div class="tab-content">
            @for($x = 1; $x <= 5; $x++)
                <div id="week{!! $x !!}" class="tab-pane fade {!! $x == 1 ? 'in active' : null !!}">
                    <div class="panel panel-default" style="border-top: none !important;">
                        <div class="panel-heading">
                            Beschikbaarheid van week {!! \Carbon\Carbon::now()->addWeeks($x)->weekOfYear !!}
                        </div>
                        <div class="panel-body">
                            @php
                                $schedule = $user->availability->where('week_nr', '=', \Carbon\Carbon::now()->addWeeks($x)->weekOfYear)->first();
                            @endphp

                            <table style="width:100%">
                                <tr>
                                    <th width="100px;">dag</th>
                                    <th colspan="">van</th>
                                    <th colspan="">tot</th>
                                </tr>
                                <tr class="time-chart">
                                    <td>{!! \Carbon\Carbon::now()->addWeeks($x)->startOfWeek()->addDays(0)->format('D d M') !!}</td>
                                    <td>
                                         @include('components.admin.time-input', ['value' => $schedule['start_monday'], 'name' => 'availabilty['.$x.'][ma][van]'])
                                    </td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['end_monday'], 'name' => 'availabilty['.$x.'][ma][tot]'])
                                    </td>
                                </tr>
                                <tr class="time-chart">
                                    <td>{!! \Carbon\Carbon::now()->addWeeks($x)->startOfWeek()->addDays(1)->format('D d M') !!}</td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['start_tuesday'], 'name' => 'availabilty['.$x.'][di][van]'])
                                    </td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['end_tuesday'], 'name' => 'availabilty['.$x.'][di][tot]'])
                                    </td>
                                </tr>
                                <tr class="time-chart">
                                    <td>{!! \Carbon\Carbon::now()->addWeeks($x)->startOfWeek()->addDays(2)->format('D d M') !!}</td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['start_wednesday'], 'name' => 'availabilty['.$x.'][wo][van]'])
                                    </td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['end_wednesday'], 'name' => 'availabilty['.$x.'][wo][tot]'])
                                    </td>
                                </tr>
                                <tr class="time-chart">
                                    <td>{!! \Carbon\Carbon::now()->addWeeks($x)->startOfWeek()->addDays(3)->format('D d M') !!}</td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['start_thursday'], 'name' => 'availabilty['.$x.'][do][van]'])
                                    </td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['end_thursday'], 'name' => 'availabilty['.$x.'][do][tot]'])
                                    </td>
                                </tr>
                                <tr class="time-chart">
                                    <td>{!! \Carbon\Carbon::now()->addWeeks($x)->startOfWeek()->addDays(4)->format('D d M') !!}</td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['start_friday'], 'name' => 'availabilty['.$x.'][vr][van]'])
                                    </td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['end_friday'], 'name' => 'availabilty['.$x.'][vr][tot]'])
                                    </td>
                                </tr>
                                <tr class="time-chart">
                                    <td>{!! \Carbon\Carbon::now()->addWeeks($x)->startOfWeek()->addDays(5)->format('D d M') !!}</td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['start_saturday'], 'name' => 'availabilty['.$x.'][za][van]'])
                                    </td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['end_saturday'], 'name' => 'availabilty['.$x.'][za][tot]'])
                                    </td>
                                </tr>
                                <tr class="time-chart">
                                    <td>{!! \Carbon\Carbon::now()->addWeeks($x)->startOfWeek()->addDays(6)->format('D d M') !!}</td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['start_sunday'], 'name' => 'availabilty['.$x.'][zo][van]'])
                                    </td>
                                    <td>
                                        @include('components.admin.time-input', ['value' => $schedule['end_sunday'],'name' => 'availabilty['.$x.'][zo][tot]'])
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    {!! Form::submit('Aanpassen', ['class' => 'btn btn-success']) !!}

    {!! Form::close() !!}

@endsection

@push('css')
    <style href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.css"></style>
    <style href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css"></style>
    <style href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker-standalone.min.css.map"></style>
    <style href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css"></style>
    {{--<style href=""></style>--}}
    <style>
        .time-chart td{
            padding: 0px 3px;
        }
        .time-chart .form-group{
            margin-bottom: 5px;
        }
        .table-bordered>tbody>tr>th{
            border-right-width: 0px !important;
        }
        .table > tbody > tr > td {
            vertical-align: middle;
            padding: 20px 10px;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });

        $(function () {
            $('.datetimepicker').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endpush