@extends('layouts.site')

@section('content')

    @component('components.site.banner-background', ['img' => '/img/social-banner.jpg'])
        @slot('title')
            <h1 class="text-center" style="font-weight: bolder; font-size: 65px;">Contact Us</h1>
        @endslot
    @endcomponent

    <section class="features-icons bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <a href="#" class="m-auto">
                                <i class="fas fa-map fa-2x fa-fw text-primary"></i>
                            </a>
                        </div>
                        <h3>Adres</h3>
                        <p class="lead mb-0">Daalakkersweg 2.182, <br>5641JA Eindhoven </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <a href="#" class="m-auto">
                                <i class="fas fa-phone fa-2x fa-fw text-primary"></i>
                            </a>
                        </div>
                        <h3>Telefoon</h3>
                        <p class="lead mb-0">
                            <a href="tel:+31 85 009 1205">+31 85 009 1205</a><br>
                            <a href="tel:+31 6 53779761">+31 6 53779761</a>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                        <div class="features-icons-icon d-flex">
                            <a href="mailto:info@mediaverse.nl" class="m-auto">
                                <i class="fas fa-at fa-2x fa-fw text-primary"></i>
                            </a>
                        </div>
                        <h3>E-mail</h3>
                        <p class="lead mb-0">
                            <a href="mailto:info@mediaverse.nl">info@mediaverse.nl</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @component('components.site.content-box', [
        'textLeft' => true,
        'content' => [
            [
                'imgContent' => view('components.site.maps'),
                'text' => view('components.site.contact-form'),
                'image' => '/img/bg-showcase-1.jpg',
            ]
        ]
    ])
    @endcomponent


@endsection

@push('css')
    <style>
        .card{
            padding: 30px;
            border: none;
            border-radius: 0px;
            background-color: #f8f9fa;
        }
        .card input,
        .card textarea,
        .card select
        {
            border-radius: 0px;

        }
        .card .form-group {
             margin-bottom: 5px !important;
        }
        .showcase .showcase-img {
            min-height: 30rem;
            text-align:center;
            /*background-size: contain;*/
            /*background-repeat: no-repeat;*/
        }

        .features-icons {
            padding-top: 5rem;
            padding-bottom: 5rem;
        }

        .features-icons .features-icons-item {
            max-width: 20rem;
        }

        .features-icons .features-icons-item .features-icons-icon {
            height: 7rem;
        }

        .features-icons .features-icons-item .features-icons-icon i {
            font-size: 4.5rem;
        }

        .features-icons .features-icons-item:hover .features-icons-icon i {
            font-size: 5rem;
        }
    </style>
@endpush

@push('js')

@endpush