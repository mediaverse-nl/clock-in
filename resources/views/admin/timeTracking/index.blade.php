@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <a href="" class="btn btn-primary">Roles</a>
     </div>

    <hr>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="btn-group pull-left" role="group" aria-label="">
                    <a class="btn btn-default"><</a>
                    <a class="btn btn-default disabled">{!! \App\Calendar::startOfWeek()->format('d M').' - '.\App\Calendar::endOfWeek()->format('d M') !!}</a>
                    <a class="btn btn-default">></a>
                </div>

                <div class="btn-group pull-left" role="group" aria-label="" style="margin-left: 5px">
                    {{--<a class="btn btn-default"><</a>--}}
                    <div class="form-group">
                         <select class="form-control" id="sel1" style="border-radius: 0px;">
                            <option>alle locaties</option>
                            <option>daalakkerseweg 2</option>
                            <option>kruisstraat 63</option>
                            <option>Eindhovenseweg 1023</option>
                         </select>
                    </div>
                </div>

                <div class="btn-group pull-right" role="group" style="">
                    {{--<a href="" class="btn btn-default">print</a>--}}
                    <a href="" class="btn btn-success"><i class="fas fa-plus"></i></a>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="col-md-12">
        <table class="table table-responsive" style="border: 0px !important;">
            <tr class="active">
                <th class="">datum </th>
                <th>persoon</th>
                <th>time card</th>
                <th>rooster</th>
                <th>gewerkt</th>
                <th></th>
                <th class="">locatie</th>
                <th class=""></th>
                {{--<th class=""> </th>--}}
            </tr>
            @for($u = 0; $u < 3; $u++)
                <tr>
                    <td class="">
                        {!! date('d M') !!}
                    </td>
                    <td style="width: 200px;">
                        <img class="img-circle" style="height: 35px; width: 35px;" src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png">
                        <div style="display: inline-block;">
                            willem
                        </div>
                    </td>
                    <td class="">
                        <b>{!! date('h:i') !!} - {!! date('h:i') !!}</b>
                    </td>
                    <td class="">
                        6:30
                    </td>
                    <td class="">
                        5:25
                    </td>
                    <td class="">
                        <span class="label label-danger">2+</span>
                    </td>
                    <td class="">
                         daalakkersweg 2
                     </td>
                    <td>
                        <a href="" class="btn btn-default pull-right">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                </tr>
            @endfor
        </table>
    </div>


@endsection

@push('css')
    <style>

        /*.table-bordered>tbody>tr>td,*/
        /*.table-bordered>tbody>tr>th:last-child{*/
            /*border-right-width: 0px !important;*/
        /*}*/
        /*.table-bordered>tbody>tr>th:first-child{*/
            /*border-left-width: 0px !important;*/
        /*}*/
        .table > tbody > tr > td {
            vertical-align: middle;
        }
    </style>
@endpush

@push('js')

@endpush