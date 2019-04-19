<div class="panel panel-default">
    <div class="panel-heading">
        {{$title}}

        @if(!empty($btn))
            {{$btn}}
        @endif
    </div>
    <div class="panel-body">
        {{$body}}
    </div>
</div>

@push('css')
    <style>

    </style>
@endpush

@push('js')
    <script>

    </script>
@endpush