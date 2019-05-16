{!! Form::open(['route' => ['admin.filter.flash'], 'method' => 'post']) !!}
    {!! Form::hidden('route_name', \Route::current()->getName()) !!}
    {!! Form::hidden('filter_name', $name) !!}
    @if($name == 'date')
        <div class="input-group" style="width: auto !important;">
            <div class="input-group-addon" style="width: 30px; border-radius: 0px;">
                <i class="fa fa-calendar"></i>
            </div>
            {!! Form::text('filter_item', $setValue, ['class' => 'form-control text-center', 'id' => 'daterange',  'autocomplete' => 'off', 'onchange' => 'this.form.submit()']) !!}
        </div>
    @else
        {!! Form::select('filter_item',$items, $setValue,['class' => 'form-control','placeholder' => $placeholder,'onchange' => 'this.form.submit()']) !!}
    @endif
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