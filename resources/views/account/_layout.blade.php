@extends('index')
@section('title')
    N-Project
@endsection
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-3">
            <div class="list-group" id="account-link-menu">
                <a id="profile" href="{{route('account.index')}}" class="list-group-item list-group-item-action">
                    <i class="fa fa-user"></i> Profile
                </a>
                <a href="{{route('account.surveys')}}" id="survey" class="list-group-item list-group-item-action"><i class="fa fa-poll"></i> Survey</a>
                <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
                <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
                <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
            </div>
        </div>
        <div class="col-md-9">
            @yield('content_account')
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
    var act_id = '@yield("active_link")';
    $(document).ready(function(ev){
        $("#account-link-menu #" + act_id).addClass('active');
    });</script>
@endpush