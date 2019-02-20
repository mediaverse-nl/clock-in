<!-- Image Showcases -->
<section class="showcase">
    <div class="container-fluid p-0">
        @if(isset($content))
            @foreach($content as $item)

                @if($loop->index % 2 == ($textLeft ? 0 : 1))
                    <div class="row no-gutters">
                        <div class="col-lg-6 order-lg-2 call-to-action overlay text-white showcase-img" style="background-image: url({!! $item['image'] !!});">
                            @if(isset($item['imgContent']))
                                {!! $item['imgContent'] !!}
                            @endif
                        </div>
                        <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                            @if(isset($item['title']))
                                <h2>{!! $item['title'] !!}</h2>
                            @endif
                            <p class="lead mb-0">{!! $item['text'] !!}</p>
                            <br>
                            <br>
                        </div>
                    </div>
                @else
                    <div class="row no-gutters">
                        <div class="col-lg-6 text-white showcase-img call-to-action overlay" style="background-image: url({!! $item['image'] !!});">
                            @if(isset($item['imgContent']))
                                {!! $imgContent !!}
                            @endif
                        </div>
                        <div class="col-lg-6 my-auto showcase-text">
                            <h2>{!! $item['title'] !!}</h2>
                            <p class="lead mb-0">{!! $item['text'] !!}</p>
                            <br>
                            <br>
                        </div>
                    </div>
                @endif

            @endforeach
        @endif

        {!! $slot !!}


    </div>
</section>

@push('css')
    <style>
        .overlay {
            /*position: absolute;*/
            /*background-color: #212529;*/
            /*height: 100%;*/
            /*width: 100%;*/
            /*top: 0;*/
            /*left: 0;*/
            /*opacity: 0.5;*/
        }
        .showcase .showcase-text {
            padding: 1rem;
        }

        .showcase .showcase-img {
            min-height: 30rem;
            background-size: cover;

        }

        /*Small devices (landscape phones, 576px and up)*/
        @media (min-width: 576px) {
            .showcase .showcase-text {
                padding: 7rem !important;
            }
        }
        /*// Medium devices (tablets, 768px and up)*/
        @media (min-width: 768px) {
            .showcase .showcase-text {
                padding: 7rem !important;
            }
        }
        /*// Large devices (desktops, 992px and up)*/
        @media (min-width: 992px) {
            .showcase .showcase-text {
                padding: 3rem !important;
            }
        }
        /*// Extra large devices (large desktops, 1200px and up)*/
        @media (min-width: 1200px) {
            .showcase .showcase-text {
                padding: 5rem !important;
            }
        }
    </style>
@endpush