@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <a href="{!! route('admin.team.index') !!}" class="btn btn-primary">Personeel</a>
        <a href="{!! route('admin.team.roles') !!}" class="active btn btn-primary">Roles</a>
    </div>

    <br>
    <br>
    <br>

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group pull-left" role="group" aria-label="">
                            <a class="btn btn-default">Nieuwe</a>
                        </div>

                    </div>
                </div>

                <hr>

                <div class="row">
                    @for($s = 1; $s < 4; $s++)

                        <div class="col-md-3">
                            <div class="panel panel-default">
                                <div class="panel-body text-center">
                                    <div class="btn-group pull-right" role="group" aria-label="">
                                        <a class="btn btn-xs btn-default">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <a class="btn btn-xs btn-default">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                    </div>
                                    @if($s == 1)
                                        <b>Manager</b>
                                    @elseif($s == 2)
                                        <b>Kassa</b>
                                    @else
                                        <b>Medewerker</b>
                                    @endif
                                </div>
                            </div>
                        </div>

                    @endfor
                </div>


            </div>
        </div>

    </div>


@endsection

@push('css')
    <style>
        .table > tbody > tr > th,
        .table > tbody > tr > td {
            vertical-align: middle;
        }
    </style>
@endpush

@push('js')

@endpush