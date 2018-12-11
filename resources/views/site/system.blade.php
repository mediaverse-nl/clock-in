@extends('layouts.site')

@section('content')

    {{--@component('components.site.banner-background')--}}
        {{--@slot('title')--}}
            {{--<h1 class="text-center" style="font-weight: bolder; font-size: 65px;">Systeem</h1>--}}
        {{--@endslot--}}
    {{--@endcomponent--}}

    <!-- Image Showcases -->
    <section class="showcase">
        <div class="container-fluid p-0">
            <div class="row no-gutters">

                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('/img/bg-showcase-1.jpg');"></div>
                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>Fully Responsive Design</h2>
                    <p class="lead mb-0">(Naam product) is een nieuwe manier van tijdregistreren. Het systeem is gericht op het efficiënter maken van administratie door dit zo simpel mogelijk te laten verlopen. De efficiëntie komt voor uit de technologische ontwikkelingen en het gemak van gebruik. Hoe makkelijker wij het maken om het systeem te gebruiken, de sneller en beter de eindgebruiker het systeem goed kan gebruiken in zijn/haar werk. De overbodige elementen in het systeem zijn daarom ook allemaal naar de achterkant gehaald voor een makkelijker te gebruiken en sneller te begrijpen lay-out. Het weghalen van specifieke knoppen in het systeem is hierin ook nog mogelijk zou de klant het nog simpeler willen hebben.</p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-6 text-white showcase-img" style="background-image: url('/img/bg-showcase-2.jpg');"></div>
                <div class="col-lg-6 my-auto showcase-text">
                    <h2>Updated For Bootstrap 4</h2>
                    <p class="lead mb-0">Een van de opties om het systeem makkelijker te maken is de NFC reader. Hiermee kan het systeem heel simpel een pasje pakken en hierop inloggen en zodra het een 2e keer de reader raakt stopt de tijd weer. Hetzelfde als wanneer u de de OV chipkaart gebruikt op de trein of in de bus. Hiernaast is er ook nog de mogelijkheid tot een numpad te gebruiken voor het inloggen. Hierbij wordt er per werknemer een eigen code gebruikt om in en uit te loggen. Het is niet alleen het in en uitloggen wat wij gemakkelijker maken. Het is vooral ook het overzicht. Het is voor medewerkers mogelijk te zien op de app of ze ingeclockt zijn en voor werkgevers en managers om alles te beheren vanaf de app of de website. Het dashboard is zo gemakkelijk dat alles makkelijk te vinden en snel te gebruiken is.</p>
                </div>
            </div>
            <div class="row no-gutters">
                <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('/img/bg-showcase-3.jpg');"></div>
                <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                    <h2>Easy to Use &amp; Customize</h2>
                    <p class="lead mb-0">Een van de laatste voordelen die het systeem biedt is afstands updates. (Product naam) heeft een beveiligde internetverbinding waardoor we op elk moment het systeem kunnen updaten en rebooten. Hiernaast is het ook mogelijk om het vanuit een afstand uit en aan te zetten mocht dit noodzakelijk zijn. Verder is er door deze verbinding niemand nodig die langskomt om het systeem te reparen mocht dit kapot zijn. Wanneer het een interne error is kunnen wij dit vanaf afstand reparen, mocht het systeem fysiek kapot zijn dan komen wij uiteraard wel meteen een nieuwe brengen, anders kunt u uw uren niet meer bijhouden natuurlijk.</p>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('css')
    <style>

        /*Small devices (landscape phones, 576px and up)*/
        @media (min-width: 576px) {
            .showcase .showcase-text {
                padding: 3rem !important;
            }
        }

        .showcase .showcase-text {
            padding: 2rem ;
        }

        .showcase .showcase-img {
            min-height: 30rem;
            background-size: cover;
        }



    </style>
@endpush

@push('js')

@endpush