@extends('account._layout')

@section('active_link','survey')


@section('content_account')
@include('account.survey.report.modal.add-chart')
<div class="card">
    <div class="card-header">
        <i class="fa fa-tachometer-alt"></i> Create Report Dashboard
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="report-name">Report dashboard title</label>
            <input type="text" class="form-control" id="report-name" name="name" required>
        </div>
        <div class="form-group">
            <label for="report-description">Description</label>
            <textarea class="form-control" id="report-description" name="description" required></textarea>
        </div>
    </div>
</div>


@endsection

@section('content-full')
<div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
                <h3 class="display-5">Report Dashboard Element</h3>
                <div>
                        <button class="btn btn-primary mt-2 dropdown-toggle" data-toggle="dropdown" id="add-element-btn"><i class="fa fa-plus"></i> Add Element</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a class="dropdown-item" href="#">Table</a>
                                <button type="button" class="dropdown-item" id="add-chart" data-toggle="modal" data-target="#exampleModal">Chart</button>
                                <a class="dropdown-item" href="#">Map</a>
                        </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-body" >
                        <div class="row" id="report-container">

                        </div>
                </div>
            </div>
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