<!-- Image Showcases -->
<section class="showcase">
    <div class="container-fluid p-0">
        @foreach($content as $item)

            @if($loop->index % 2 == ($textLeft ? 0 : 1))
                <div class="row no-gutters">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('{!! $item['image'] !!}');"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2>{!! $item['title'] !!}</h2>
                        <p class="lead mb-0">{!! $item['text'] !!}</p>
                    </div>
                </div>
            @else
                <div class="row no-gutters">
                    <div class="col-lg-6 text-white showcase-img" style="background-image: url('{!! $item['image'] !!}');"></div>
                    <div class="col-lg-6 my-auto showcase-text">
                        <h2>{!! $item['title'] !!}</h2>
                        <p class="lead mb-0">{!! $item['text'] !!}</p>
                    </div>
                </div>
            @endif

        @endforeach

    </div>
</section>

@push('css')
    <style>

        .showcase .showcase-text {
            padding: 3rem;
        }

        .showcase .showcase-img {
            min-height: 30rem;
            background-size: cover;
        }

        @media (min-width: 768px) {
            .showcase .showcase-text {
                padding: 7rem;
            }
        }
    </style>
@endpush