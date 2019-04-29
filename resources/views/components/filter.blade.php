{!! Form::open(['route' => ['admin.filter.flash'], 'method' => 'post']) !!}
    {!! Form::hidden('route_name', \Route::current()->getName()) !!}
    {!! Form::hidden('filter_name', $name) !!}
    {!! Form::select('filter_item',$items, $setValue,['class' => 'form-control','placeholder' => $placeholder,'onchange' => 'this.form.submit()']) !!}
{!! Form::close() !!}

@push('css')
    <style>
        .form-control{
            border-radius: 0px;
        }
    </style>
@endpush

@push('js')
    <script>

    </script>
@endpush