<div class="panel panel-default">
    <div class="panel-heading">
        {{$title}}

        @if(!empty($btn))
            {{$btn}}
        @endif
    </div>
    <div class="panel-body">
        <table id="data-table" class="display">
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
            $('#data-table').DataTable();
        } );
    </script>
@endpush