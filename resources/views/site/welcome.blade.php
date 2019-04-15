@extends('layouts.site')

@section('content')
    <!-- Masthead -->
    <header class="masthead text-white text-center">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <h1 class="mb-5">Build a landing page for your business or project and generate more leads!</h1>
                </div>
                <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                    <form>
                        <div class="form-row">
                            <div class="col-12 col-md-9 mb-2 mb-md-0">
                                <input type="email" class="form-control form-control-lg" placeholder="Enter your email...">
                            </div>
                            <div class="col-12 col-md-3">
                                <button type="submit" class="btn btn-block btn-lg btn-primary">Sign up!</button>
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col-12 col-md-9 mb-2 mb-md-0">
                                <select name="" id="" class="form-control">
                                    <option value="" disabled selected>aantal werknemers</option>
                                    <option value="">1 ~ 5</option>
                                    <option value="">6 ~ 10</option>
                                    <option value="">11 ~ 20</option>
                                    <option value="">21 ~ 50</option>
                                </select>
                            </div>
                        </div>

                        <br>
                        <div class="form-row">
                            <div class="col-12 col-md-9 mb-2 mb-md-0">

                                <select name="" id="" class="form-control">
                                    <option value="" disabled selected>aantal locaties</option>
                                    @for($i = 1; $i <= 100; $i++)
                                        <option value="{!! $i !!}">{!! $i !!}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Icons Grid -->
    <section class="features-icons bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <a href="{!! route('system.index') !!}" class="m-auto">
                                <i class="fas fa-server fa-2x fa-fw text-primary"></i>
                            </a>
                        </div>
                        <h3>Systeem</h3>
                        <p class="lead mb-0">This theme will look great on any device, no matter the size!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <a href="{!! route('service.index') !!}" class="m-auto">
                                <i class="fas fa-concierge-bell fa-2x fa-fw text-primary"></i>
                            </a>
                        </div>
                        <h3>Diensten</h3>
                        <p class="lead mb-0">Featuring the latest build of the new Bootstrap 4 framework!</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <a href="{!! route('roadmap.index') !!}" class="m-auto">
                                <i class="fas fa-map-signs fa-2x fa-fw text-primary"></i>
                            </a>
                        </div>
                        <h3>Roadmap</h3>
                        <p class="lead mb-0">Ready to use with your own content, or customize the source files!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @component('components.site.content-box', [
        'textLeft' => true,
        'content' => [
            [
                'title' => 'clock in system',
                'text' => 'test',
                'image' => '/img/calendar.jpg',
            ],[
                'title' => 'features',
                'text' => view('components.site.text-box.features'),
                'image' => '/img/features.jpg',
            ],[
                'title' => 'free trail',
                'text' => 'test',
                'image' => '/img/agreement.jpg',
            ]

        ]
    ])
    @endcomponent
    {{--,[--}}
    {{--'title' => 'test',--}}
    {{--'text' => 'test',--}}
    {{--'image' => '/img/bg-showcase-1.jpg',--}}
    {{--],--}}





    <!-- Testimonials -->
    <section class="testimonials text-center bg-light">
        <div class="container">
            <h2 class="mb-5">What people are saying...</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="img/testimonials-1.jpg" alt="">
                        <h5>Margaret E.</h5>
                        <p class="font-weight-light mb-0">"This is fantastic! Thanks so much guys!"</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="img/testimonials-2.jpg" alt="">
                        <h5>Fred S.</h5>
                        <p class="font-weight-light mb-0">"Bootstrap is amazing. I've been using it to create lots of super nice landing pages."</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="img/testimonials-3.jpg" alt="">
                        <h5>Sarah	W.</h5>
                        <p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="img/logos/envato.jpg" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="img/logos/designmodo.jpg" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="img/logos/themeforest.jpg" alt="">
                    </a>
                </div>
                <div class="col-md-3 col-sm-6">
                    <a href="#">
                        <img class="img-fluid d-block mx-auto" src="img/logos/creative-market.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    @component('components.site.banner-background', ['title' => 'Ga aan de slag met Space'])
        <p>
            Space geeft je alles wat je nodig hebt om zaken te doen, geweldige dingen te bouwen en je doelen te bereiken.
            <br>
            <br>
            <a href="{!! route('contact.index') !!}" class="btn btn-lg btn-primary">neem contact op</a>
        </p>
    @endcomponent

@endsection

@push('css')
    <link rel="stylesheet" href="/css/site/welcome.css">
    {{--<link href="/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">--}}

    <style>
        /*.business-header {*/
            /*height: 50vh;*/
            /*min-height: 300px;*/
            /*background: url('http://placehold.it/1920x400') center center no-repeat scroll;*/
            /*-webkit-background-size: cover;*/
            /*-moz-background-size: cover;*/
            /*background-size: cover;*/
            /*-o-background-size: cover;*/
        /*}*/

        /*.card {*/
            /*height: 100%;*/
        /*}*/
    </style>
@endpush

@push('js')

@endpush