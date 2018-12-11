<!-- Call to Action -->
<section class="action-banner text-white text-center masthead overlay">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h2 class="mb-4">{!! $title !!}</h2>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                {!! $slot !!}
            </div>
        </div>
    </div>
</section>

@push('css')
<style>
    .action-banner {
        @if(isset($img))
            background: url("{!! $img !!}") no-repeat center center;
        @else
            background: url("/img/contact-us.jpg") no-repeat center center;
        @endif
        position: relative;
        background-color: #343a40;
        background-size: cover;
        padding-top: 7rem;
        padding-bottom: 7rem;
    }

    .action-banner .overlay {
        position: absolute;
        background-color: #212529;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        opacity: 0.7;
    }
</style>
@endpush