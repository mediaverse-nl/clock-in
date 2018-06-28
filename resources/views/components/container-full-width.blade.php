
<div class="row">
    <div class="col-md-12 dash-board">
        <div class="panel panel-default">
            <div class="panel-body">
                {{$slot}}
            </div>
        </div>
    </div>
</div>

@push('css')
<style>
    .dash-board{
        padding: 0px !important;
        margin-top: -25px;
        color: #FFFFFF;
    }
    .dash-board > .panel{
        border: 0px !important;
        border-radius: 0px !important;
        min-height: 200px;
        background: #3F51B5;
    }
</style>
@endpush