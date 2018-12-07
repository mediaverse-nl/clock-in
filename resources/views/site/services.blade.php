@extends('layouts.site')

@section('content')

    @component('components.site.banner-background', ['title' => 'Diensten'])
        sadasd
    @endcomponent

    <div class="container" style="padding: 100px 0px;">

        {{--<h1 class="text-left" style="font-weight: bolder; font-size: 65px;">Diensten</h1>--}}

        <br>

        <div class="row">

            <div class="col-12">

                <div class="card-group services-panel">
                    <div class="card">
                        {{--<img class="card-img-top" src=".../100px180/" alt="Card image cap">--}}
                        <div class="card-body">
                            <h5 class="card-title">small</h5>
                            <p class="card-text">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>personeelsleden</b> <span class="pull-right">1 ~ 5</span></li>
                                    <li class="list-group-item"><b>apparat(en)</b> <span class="pull-right">1 x</span></li>
                                    <li class="list-group-item"><b>NFC tags</b> <span class="pull-right">1 x</span></li>
                                </ul>
                                <br>
                                <a class="btn btn-primary" style="color: #FFFFFF">bestel</a>

                                <span class="pull-right">
                                    <span>vanaf</span>
                                    <h3>17,50 <small>p.m.</small></h3>
                                </span>

                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                    <div class="card">
                        {{--<img class="card-img-top" src=".../100px180/" alt="Card image cap">--}}
                        <div class="card-body">
                            <h5 class="card-title">normal</h5>
                            <p class="card-text">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>personeelsleden</b> <span class="pull-right">6 ~ 15</span></li>
                                    <li class="list-group-item"><b>apparat(en)</b> <span class="pull-right">1 x</span></li>
                                    <li class="list-group-item"><b>NFC tags</b> <span class="pull-right">1 x</span></li>
                                </ul>
                                <br>
                                <a class="btn btn-primary" style="color: #FFFFFF">bestel</a>
                                <span class="pull-right">
                                    <span>vanaf</span>
                                    <h3>17,50 <small>p.m.</small></h3>
                                </span>
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                    <div class="card">
                        {{--<img class="card-img-top" src=".../100px180/" alt="Card image cap">--}}
                        <div class="card-body">
                            <h5 class="card-title">large</h5>
                            <p class="card-text">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>personeelsleden</b> <span class="pull-right">16 ~ 50</span></li>
                                <li class="list-group-item"><b>apparat(en)</b> <span class="pull-right">1 x</span></li>
                                <li class="list-group-item"><b>NFC tags</b> <span class="pull-right">1 x</span></li>
                            </ul>
                            <br>
                            <a class="btn btn-primary" style="color: #FFFFFF">bestel</a>

                            <span class="pull-right">
                                    <span>vanaf</span>
                                    <h3>17,50 <small>p.m.</small></h3>
                                </span>

                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>
                    <div class="card">
                        {{--<img class="card-img-top" src=".../100px180/" alt="Card image cap">--}}
                        <div class="card-body">
                            <h5 class="card-title">custom</h5>
                            <p class="card-text">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>personeelsleden</b> <span class="pull-right">1 ~ 5</span></li>
                                <li class="list-group-item"><b>apparat(en)</b> <span class="pull-right">1 x</span></li>
                                <li class="list-group-item"><b>NFC tags</b> <span class="pull-right">1 x</span></li>
                            </ul>
                            <br>
                            <a class="btn btn-primary" style="color: #FFFFFF">bestel</a>

                            <span class="pull-right">
                                <span>vanaf</span>
                                    <h3>17,50 <small>p.m.</small></h3>
                                </span>
                            </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-muted">Last updated 3 mins ago</small>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>

@endsection

@push('css')
    <style>
        .services-panel .list-group-flush .list-group-item{
            padding-left: 0px;
            padding-right: 0px;
        }
    </style>
@endpush

@push('js')

@endpush