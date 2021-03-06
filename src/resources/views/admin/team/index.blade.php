@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <a href="{!! route('admin.team.index') !!}" class="active btn btn-primary">Personeel</a>
                <a href="{!! route('admin.team.roles') !!}" class="btn btn-primary">Roles</a>
            </div>

            <div class="col-md-6">
                <div style="margin-left: 10px;" class="btn-group pull-right" href="{!! route('admin.team.create') !!}" role="group" aria-label="">
                    <a href="{!! route('admin.team.create') !!}" class="btn btn-default" data-toggle="tooltip" data-placement="top" title="Voeg een gebruiker toe">
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

    <hr>

    <div class="col-md-12">
        <table class="table table-responsive table-striped" style="border: 0px !important;">
            <tr>
                <th></th>
                <th class="">email</th>
                <th class="">clock in code</th>
                <th class="">contract uren</th>
                <th class="">hourly rate</th>
                <th class=""></th>
            </tr>

            @foreach($users as $user)
                <tr>
                    <td style="width: 200px;">
                        <img class="img-circle" style="height: 35px; width: 35px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
                        <div style="margin-left:10px; display: inline-block;">
                            {!! $user->name !!}
                        </div>
                    </td>
                    <td class="">
                        <div style="display: inline-block;">
                            {!! $user->email !!}
                        </div>
                    </td>
                    <td class="">
                        <div style="display: inline-block;">
                            {!! $user->clock_in_code !!}
                        </div>
                    </td>
                    <td class="">
                        <div style="display: inline-block;">
                            0
                        </div>
                    </td>
                    <td class="">
                        <div style="display: inline-block;">
                            &euro;0.00
                        </div>
                    </td>
                    <td>
                        <a href="{!! route('admin.team.edit', $user->id) !!}" class="btn btn-warning pull-right">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

            @for($u = 0; $u < 3; $u++)

            @endfor
        </table>
    </div>


@endsection

@push('css')
    <style>
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
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endpush