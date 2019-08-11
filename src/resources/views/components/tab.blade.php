<ul class="nav nav-tabs">
    @foreach($tabs as $tab)
        @if(!$loop->first)
            <li><a data-toggle="tab" href="#{!! $tab !!}">{!! $tab !!}</a></li>
        @else
            <li class="active"><a data-toggle="tab" href="#{!! $tab !!}">{!! $tab !!}</a></li>
        @endif
    @endforeach
 </ul>

<div class="tab-content">
    <br>
    @foreach($tabs as $tab)
         @if(!$loop->first)
            <div id="{!! $tab !!}" class="tab-pane fade">
         @else
            <div id="{!! $tab !!}" class="tab-pane fade in active">
         @endif
             {!! ${$tab} !!}
        </div>
    @endforeach
</div>

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script>

    </script>
@endpush