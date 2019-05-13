@extends('account._layout')

@section('active_link','profile')
@section('content_account')
<div class="card">
        <div class="card-header"><i class="fa fa-users"></i> Form Maintainer</div>
        <div class="card-body">
        <p class="text-justify"> daftar pengguna yang memiliki akses ke survey <strong>{{$form->name}}</strong></p>
        <hr>
        </div>
    </div>
@endsection