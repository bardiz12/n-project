@extends('index')
@section('content')
<div class="wrap" style="padding-top: 40px;">
    <h2 style="text-align:center;font-weight:bold;">Hasil Pemilu</h2>
    <div style="width:50%;margin:0 auto; margin-top: 30px;" >
            {!! $chart->container() !!}
    </div>
    <br><br>
    <h2 style="text-align:center;font-weight:bold;">Pembagian Kursi</h2><br>
    <table class="table table-bordered" style="width:60%;margin:0 auto;">
        <thead>
            <tr>
                <th>Nama Partai</th>
                <th>Jumlah Kursi</th>
            </tr>
        </thead>
        @foreach ($hasil as $item)
        <tr>
            <td>{{$item['nama_partai']}} </td>    
            <td>{{$item['jumlah_kursi']}}</td>    
        </tr>    
        @endforeach
        <tr>
            <td><b>Jumlah Kursi</b></td>
            <td>10</td>
        </tr>
        
    </table>
</div>
@endsection
@push('scripts')
{!! $chart->script() !!}
@endpush