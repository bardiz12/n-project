@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Buat Survey Baru</div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Nama Survey</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Survey">
                    </div>
                    <div class="form-group">
                        <label for="description">Deskripsi Survey</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Nama Survey"></textarea>
                    </div>
                    
                    
                    <div id="kolom">
                        <div class="form-group">
                            <label for="description">Deskripsi Survey</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Nama Survey"></textarea>
                        </div>
                    </div>
                    <div class="form-group text-right">
                            <button class="btn btn-primary">Tambah Pertanyaan</button>
                        </div>
                        

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
