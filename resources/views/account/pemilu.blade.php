@extends('account._layout')
@include('plugins.ajax-form')
@section('active_link','pemilu')
@section('content_account')
<div class="card">
        <div class="card-header">
            <span class="d-flex justify-content-between align-items-center">
                <span><i class="fa fa-poll-h"></i> Survey Pemilu DPR RI</span>
                
            </span>
        </div>
        <div class="card-body" style="padding-left: 30px;">
            
                    <h5>Silahkan Pilih Calon Anggota DPR RI yang anda suka !</h5>
                    
                <form action="{{route('account.pilih_dpr')}}" data-form-ajax='true' data-reset='true' method="POST" id="form-pilih">
                <div class="row">
                    @foreach ($calon as $item)
                        
                    <div class="col-xs-1 col-sm-1 col-md-3">
                        
                            <div class="card" style="margin-top: 15px;">
                                <label for="pilih{{$item->id}}" style="padding:0;margin:0;">
                                <img class="card-img-top" src="{{$item->foto}} " alt="">
                                <div class="card-body">
                                    <h4 class="card-title">{{$item->nama_calon_dpr}} </h4>
                                    <p class="card-text">Pilih <input type="radio" name="pilih_dpr" id="pilih{{$item->id}}" value="{{$item->id}}" 
                                        @php
                                            foreach (Auth::user()->calon_dpr()->get() as $key => $value) {
                                                # code...
                                                if ($value->id == $item->id) {
                                                    # code...
                                                    echo "checked";
                                                }
                                            }
                                        @endphp
                                        
                                        ></p>
                                </div>
                            </label>
                            </div>
                        
                    </div>
                    @endforeach
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
        </div>
    </div>
@endsection