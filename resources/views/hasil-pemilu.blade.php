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
            <td>{{$jumlah_kursi}}  </td>
        </tr>
        
    </table>
    <h2 style="text-align:center;font-weight:bold;margin-top: 25px;">Daftar Calon Terpilih DPR RI</h2>

    <table class="table table-bordered">
        <tr>
            <th>Nama Partai</th>
            <th>Calon </th>
        </tr>
        @foreach ($hasil as $item)
            @foreach (\App\Model\Partai::where('id',$item['partai_id'])->get() as $items)
                

            <tr>
                <td style="width:10%;">
                    <div class="card">
                            <img src="{{$items->logo}} " alt="" style="width:150px;height:150px;">
                        <div class="card-body">
                                <h5 class="card-title">{{$items->nama_partai}}</h5>
                        </div>
                    </div>
                </td>
                <td>
                @foreach ($items->calon_dpr()->get()->sortByDesc(function($calon_dpr){
                    return $calon_dpr->users()->count();
                })->take($item['jumlah_kursi']) as $itemss)
                        <div class="card" style="width:150px;min-height:200px;float:left;margin-right:20px;">
                            <img src="{{$itemss->foto}} " alt="" style="width:150px;height:150px;">
                        <div class="card-body">
                                <h5 class="card-title">{{$itemss->nama_calon_dpr}}</h5>
                        </div>
                    </div>
                @endforeach
                </td>    
            </tr>            
            @endforeach
        @endforeach
    
    </table>
</div>
@endsection
@push('scripts')
{!! $chart->script() !!}
@endpush