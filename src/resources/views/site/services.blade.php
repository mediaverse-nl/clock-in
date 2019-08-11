@extends('layouts.site')

@section('content')

    @component('components.site.banner-background', ['title' => 'Diensten', 'img' => '/img/agenda-analysis-business.jpg'])
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
                       'title' => 'Wat betaald u, €1 per personeelslid.',
                       'text' => 'Onze systeem kost 1 euro per personeelslid per maand',
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
               'textLeft' => true,
               'content' => [
                   [
                       'title' => '1 terminal per locatie',
                       'text' => 'Onze terminal kost 13,50 per maand. u kunt dan kiezen uit de num pad of de NFC editie. <br> <small>Als u meer dan 20 personeelsleden heeft, krijg u de 1ste terminal gratis.</small>',
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
                       'title' => 'NFC tags',
                       'text' => 'NFC tags zijn in veel soorten en maten te verkrijgen. Alles kan op maakt gemaakt worden<br> ',
                       'image' => '/img/bg-showcase-1.jpg',
                   ]
               ]
            ])
            @endcomponent
        </div>

        <br>
        <br>
        <br>
        <br>

    </div>

@endsection

@push('css')
    <style>
        .card{
            border: none;
            border-radius: 0px;
        }
        .showcase .showcase-img {
            min-height: 15rem;
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