<!-- Call to Action -->
<section class="call-to-action text-white text-center">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-9 mx-auto">
                <h2 class="mb-4">{!! $title !!}</h2>
            </div>
            <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
                {!! $slot !!}
                {{--<form>--}}
                    {{--<div class="form-row">--}}
                        {{--<div class="col-12 col-md-9 mb-2 mb-md-0">--}}
                            {{--<input type="email" class="form-control form-control-lg" placeholder="Enter your email...">--}}
                        {{--</div>--}}
                        {{--<div class="col-12 col-md-3">--}}
                            {{--<button type="submit" class="btn btn-block btn-lg btn-primary">Sign up!</button>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</form>--}}
            </div>
        </div>
    </div>
</section>

@push('css')
<style>

    .call-to-action {
        @if(isset($img))
            background: url("{!! $img !!}") no-repeat center center;
        @else
            background: url("/img/agenda-banner.jpg") no-repeat center center;
        @endif
        position: relative;
        background-color: #343a40;
        background-size: cover;
        padding-top: 7rem;
        padding-bottom: 7rem;
    }

    .call-to-action .overlay {
        position: absolute;
        background-color: #212529;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        opacity: 0.5;
    }
</style>
@endpush