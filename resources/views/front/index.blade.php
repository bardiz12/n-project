@extends('index')
@section('title')
    N-Project
@endsection
@section('content')
<section id="banner">
    <div class="bg"></div>
    <div class="bg2">
       <h1>N-Project Survey Generator</h1>  
    </div>
</section>
<section id="button">
    <div class="wrap" style="text-align:center;">
        <a href="/register"><button class="btn btn-primary btn-lg">Register</button></a>
        <a href="/login"><button class="btn btn-success btn-lg">Login</button></a>
    </div>
</section>
@endsection