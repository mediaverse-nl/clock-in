@extends('layouts.app')

@section('content')

    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Dashboard
            </div>
            <div class="panel-body">

                @foreach(DB::table("clocked")
                    ->select("*" ,DB::raw("(SUM(worked_min)) as total_min"))
                    ->orderBy('created_at')
                    ->groupBy(DB::raw("WEEK(created_at)"))
                    ->get()->toArray() as $item)

                    {{var_dump($item)}}
                    <br>
                    <br>
                @endforeach

                this month
                {!! $checked->sum('worked_min') !!}

            </div>
        </div>
    </div>


@endsection

@push('js')

@endpush