@extends('layouts.admin')

@section('content')

    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1>Hoofd locatie</h1>
                {!! $business !!}

                <br>
                <br>
                <br>
                <table class="table">
                    <thead>
                        <tr>
                            <th>locatie code</th>
                            <th>apparaten</th>
                            <th>Postcode</th>
                            <th>Adres</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($locations as $location)
                        <tr>
                            <td>{!! $location->id !!}</td>
                            <td>{!! $location->devices->count() !!}</td>
                            <td>{!! $location->postal_code !!}</td>
                            <td> {!! $location->fulAddress !!}</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>


@endsection

@push('css')

@endpush

@push('js')

@endpush