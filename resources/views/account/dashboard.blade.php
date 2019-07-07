@extends('account._layout')

@section('active_link','profile')
@section('content_account')
<div class="card">
        <div class="card-header">Dashboard</div>
        <div class="card-body">
            Selamat Datang <b> {{Auth::user()->name}}</b> ! 
        </div>
    </div>
@endsection