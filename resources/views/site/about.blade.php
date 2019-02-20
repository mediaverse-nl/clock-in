@extends('layouts.site')

@section('content')

    @component('components.site.banner-background', ['img' => '/img/over-ons.jpg'])
        @slot('title')
            <h1 class="my-4">About Us
                <small>It's Nice to Meet You!</small>
            </h1>
        @endslot
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, explicabo dolores ipsam aliquam inventore corrupti eveniet quisquam quod totam laudantium repudiandae obcaecati ea consectetur debitis velit facere nisi expedita vel?</p>
    @endcomponent

    <!-- Page Content -->
    <div class="container">

        <!-- Introduction Row -->

    </div>
    <!-- /.container -->

    <!-- Testimonials -->
    <section class="testimonials text-center">
        <div class="container">
            <h2 class="mb-5">Our Team</h2>
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="img/testimonials-1.jpg" alt="">
                        <h5>Deveron Reniers</h5>
                        <span class="font-weight-dark">CEO</span>
                        <p class="font-weight-light mb-0"></p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="img/testimonials-2.jpg" alt="">
                        <h5>Maximiliaan Einderhand</h5>
                        <span class="font-weight-dark">Marketing</span>
                        <p class="font-weight-light mb-0"></p>
                    </div>
                </div>
                {{--<div class="col-sm-6 col-md-6 col-lg-3">--}}
                    {{--<div class="testimonial-item mx-auto mb-5 mb-lg-0">--}}
                        {{--<img class="img-fluid rounded-circle mb-3" src="img/testimonials-3.jpg" alt="">--}}
                        {{--<h5>Sarah	W.</h5>--}}
                        {{--<p class="font-weight-light mb-0">"Thanks so much for making these free resources available to us!"</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>

    </section>

@endsection

@push('css')
    <style>

        .testimonials {
            padding-top: 7rem;
            padding-bottom: 7rem;
        }

        .testimonials .testimonial-item {
            max-width: 18rem;
        }

        .testimonials .testimonial-item img {
            max-width: 12rem;
            -webkit-box-shadow: 0px 5px 5px 0px #adb5bd;
            box-shadow: 0px 5px 5px 0px #adb5bd;
        }

    </style>
@endpush

@push('js')

@endpush