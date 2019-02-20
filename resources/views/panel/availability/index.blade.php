@extends('layouts.app')

@section('content')

    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading">
                Standaard beschikbaarheid
                <a href="" class="btn btn-default pull-right">dsads</a>
            </div>
                <table class="table">
                    <tr>
                        <th>Maandag</th>
                        <td>1</td>
                    </tr>
                    <tr>
                        <th>Dinsdag</th>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th>Woensdag</th>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th>Donderdag</th>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th>Vrijdag</th>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th>Zaterdag</th>
                        <td>2</td>
                    </tr>
                    <tr>
                        <th>Zondag</th>
                        <td>2</td>
                    </tr>
                </table>
            {{--</div>--}}
        </div>
    </div>

    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-heading">
                Verlof
            </div>
            <div class="panel-body">
                <div class="form-group ">
                    <label for="name">User Name</label>
                    <input class="form-control" disabled="" name="name" type="text" value="jan" id="name">
                </div>
            </div>
            <table class="table">
                <tr>
                    <th>tes</th>
                    <td>1</td>
                </tr>
                <tr>
                    <th>tes3</th>
                    <td>2</td>
                </tr>
            </table>
        </div>
    </div>

@endsection

@push('css')

@endpush

@push('js')

@endpush