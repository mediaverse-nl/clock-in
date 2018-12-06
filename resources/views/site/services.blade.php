@extends('layouts.site')

@section('content')

    <div class="container" style="padding: 100px 0px;">

        <h1 class="text-left" style="font-weight: bolder; font-size: 65px;">Diensten</h1>

        <br>
        <br>
        <br>

        <div class="row">

            <div class="col-12">

                <div class="card-group">
                    <div class="card">
                        {{--<img class="card-img-top" src=".../100px180/" alt="Card image cap">--}}
                        <div class="card-body">
                            <h5 class="card-title">small
                                {{--<small class="pull-right">sadasd</small>--}}
                            </h5>
                            <p class="card-text">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>personeelsleden</b> <span class="pull-right">1 ~ 5</span></li>
                                    <li class="list-group-item"><b>apparat(en)</b> <span class="pull-right">1 x</span></li>
                                    <li class="list-group-item"><b>NFC tags</b> <span class="pull-right">1 x</span></li>
                                </ul>

                                <br>
                                <a class="btn btn-primary" style="color: #FFFFFF">bestel</a>

                                <span class="pull-right"><h3>17,50 p/mnd</h3></span>

                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                    <div class="card">
                        {{--<img class="card-img-top" src=".../100px180/" alt="Card image cap">--}}
                        <div class="card-body">
                            <h5 class="card-title">ul c title</h5>
                            <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                    <div class="card">
                        {{--<img class="card-img-top" src=".../100px180/" alt="Card image cap">--}}
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                    <div class="card">
                        {{--<img class="card-img-top" src=".../100px180/" alt="Card image cap">--}}
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                    {{--<div class="card">--}}
                    {{--<img class="card-img-top" src=".../100px180/" alt="Card image cap">--}}
                    {{--<div class="card-body">--}}
                    {{--<h5 class="card-title">Card title</h5>--}}
                    {{--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>--}}
                    {{--</div>--}}
                    {{--<div class="card-footer">--}}
                    {{--<small class="text-muted">Last updated 3 mins ago</small>--}}
                    {{--</div>--}}
                    {{--</div>--}}
                </div>
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