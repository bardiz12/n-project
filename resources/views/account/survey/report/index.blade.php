@extends('account._layout')

@section('active_link','survey')


@section('content_account')
@include('account.survey.report.modal.add-chart')
<div class="card">
    <div class="card-header">
        <i class="fa fa-tachometer-alt"></i> Survey Dashboard
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <h3>Large</h3>
            </div>
            <div class="col-6">
                <h3>Medium</h3>
            </div>
            <div class="col-6">
                <h3>Small</h3>
            </div>
        </div>
    </div>
</div>


@endsection

@section('content-full')
<div class="col-md-12">
        
</div>
@endsection
@push('scripts')
    <script>
        var sizes = ['md-4','md-6','md-12'];
        var chart_type = (JSON.parse('{!! json_encode($chart_type) !!}'));
        var form = {!! $form !!}
        $(document).ready(function(ev){
            $("#add-chart").click(function(e){
                console.log($(this));
            });
        });
    </script>
@endpush