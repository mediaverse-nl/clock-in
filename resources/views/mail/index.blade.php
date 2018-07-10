@extends('layouts.app')

@section('content')
    <div>

        <div class="col-md-4">
            <ul>
                {{--{{dd($aFolder)}}--}}
                @foreach($aFolder as $f)
                    <li>
                        {!! $f->fullName !!}
                        {{--{!! dd($oFolder) !!}--}}
                        {{--{!! var_dump($oFolder) !!}--}}

                        @if($f->has_children)
                            maps

                            @foreach($f as $f2)

                                {{--{!!  dd($f2)!!}--}}
                            @endforeach

                            {{--{!! dd($f) !!}--}}

                        @endif
                    </li>

                @endforeach
            </ul>
        </div>
        <div class="col-md-8">


            @foreach($aFolder as $f)
                {{--{!! dd($f) !!}--}}

            @foreach($f->getMessages('ALL', null, false, false)->paginate(5) as $m)
                    {!! $m->subject !!}
                    {!! $m->date !!}
                    <br>
                @endforeach
            @endforeach

            {{--@foreach($oFolder as $f)--}}

                {{--@foreach($f->getMessages('ALL', null, false, false) as $FolderChildren)--}}
                    {{--{!! $FolderChildren->subject !!} <br>--}}
                {{--@endforeach--}}
            {{--@endforeach--}}

        </div>

    </div>
@endsection

@push('js')
<script>

</script>
@endpush

@push('css')
<style>

</style>
@endpush
