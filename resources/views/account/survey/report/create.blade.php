@extends('account._layout')

@section('active_link','survey')
@section('content_account')
<div class="card">
    <div class="card-header">
        <i class="fa fa-tachometer-alt"></i> Create Report Dashboard
    </div>
    <div class="card-body">

    </div>
</div>

<div class="d-flex justify-content-between align-items-center">
    <h3 class="display-5">Report Dashboard Element</h3>
    <div>
            <button class="btn btn-primary mt-2 dropdown-toggle" data-toggle="dropdown" id="add-element-btn"><i class="fa fa-plus"></i> Add Element</button>
            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <a class="dropdown-item" href="#">Table</a>
                    <a class="dropdown-item" href="#">Chart</a>
                    <a class="dropdown-item" href="#">Map</a>
            </div>
    </div>
</div>
<div id="report-container">

</div>


@endsection

@push('scripts')
    <script>
        $(document).ready(function(ev){
            $("#add-elemen-btn").click(function(e){
                
            });
        });
    </script>
@endpush