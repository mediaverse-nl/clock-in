<div class="panel panel-default">
    <div class="panel-heading">
        {{$title}}

        @if(!empty($btn))
            {{$btn}}
        @endif
    </div>
    <div class="panel-body">
        <table id="data-table-{{str_replace(' ', '-', $title)}}" class="table table-striped table-compact">
            <thead>
            <tr>
                {{$head}}
            </tr>
            </thead>
            <tbody>
                {{$body}}
            </tbody>
        </table>
    </div>
</div>

@push('js')
    <script>
        $(document).ready( function () {
            $('#data-table-{{str_replace(' ', '-', $title)}}').DataTable();
        } );
    </script>
@endpush