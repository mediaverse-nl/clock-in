@extends('layouts.site')

@section('content')

    @component('components.site.banner-background', ['title' => 'Diensten'])
        sadasd
    @endcomponent

    <br>
    <br>

    <div class="container">
        <div class="card shadow ">
            @component('components.site.content-box', [
               'textLeft' => false,
               'content' => [
                   [
                       'title' => 'Wat betaald u',
                       'text' => 'het systeem kost 1 euro per personeelslid per maand',
                       'image' => '/img/bg-showcase-1.jpg',
                   ]
               ]
            ])
            @endcomponent
        </div>

        <br>
        <br>

        <div class="card shadow ">
            @component('components.site.content-box', [
               'textLeft' => false,
               'content' => [
                   [
                       'title' => '1 terminal per locatie',
                       'text' => 'Onze terminal kost 13,50 per maand. u kunt dan kiezen uit de num pad of de NFC editie',
                       'image' => '/img/bg-showcase-1.jpg',
                   ]
               ]
            ])
            @endcomponent
        </div>

    </div>

    <br>
    <br>


@endsection

@push('css')
    <style>
        .card{
            border: none;
            border-radius: 0px;
        }
        .showcase .showcase-img {
             min-height: 20rem;
            background-size: cover;
        }
        .showcase .showcase-text {
            padding: 3rem;
        }

        @media (min-width: 768px) {
            .showcase .showcase-text {
                padding: 3rem;
            }
        }
        .services-panel .list-group-flush .list-group-item{
            padding-left: 0px;
            padding-right: 0px;
        }
    </style>
@endpush

@push('js')

@endpush