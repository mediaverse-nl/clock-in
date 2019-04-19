<div class="panel panel-default">
    <div class="panel-heading">
        {{$title}}

        @if(!empty($btn))
            {{$btn}}
        @endif
    </div>
    <div class="panel-body">
        <table id="data-table-{{str_replace(' ', '-', $title)}}" class="table table-striped table-compact table-bordered">
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

@push('css')
    <style>
        .no-sort{
            width: 50px;
        }
        #data-table-{{str_replace(' ', '-', $title)}} .btn-group{
            width: 100% !important;
        }
        #data-table-{{str_replace(' ', '-', $title)}} .btn-group > .btn{
            width: 100% !important;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready( function () {
            $('#data-table-{{str_replace(' ', '-', $title)}}').DataTable({
                "order": [[
                    0, "desc"
                ]],
                "columnDefs": [ {
                    "targets"  : 'no-sort',
                    "orderable": false
                }]
            });
        } );
    </script>
@endpush