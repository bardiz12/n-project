@extends('index')

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
                        
                    </div>
                    <div class="form-group text-right">
                        <div class="d-flex justify-content-between">
                                <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Tambah Pertanyaan
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" id="btn-add-group">
                                            <button data-type="text" class="dropdown-item" type="button">Text</button>
                                            <button data-type="textarea" class="dropdown-item" type="button">Textarea</button>
                                            <button data-type="checkbox"  class="dropdown-item" type="button">Checkbox</button>
                                            <button data-type="radio" class="dropdown-item" type="button">Radio button</button>
                                            <button data-type="select" class="dropdown-item" type="button">Select</button>
                                        </div>
                                    </div>

                                <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                        

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function addPilihan(trig){
            var pr = $(trig).parent().parent().parent();
            pr.find('#konten-pilihan').append(`<input class="form-control mt-1" placeholder="masukan pilihan jawaban"/>`);
        }

        function removePilihan(trig){
            var pr = $(trig).parent().parent().parent();
            var inputs = pr.find('#konten-pilihan input');
            if(inputs.length > 1) inputs.last().remove();
        }

        function template_text(type){
            return `<div>
                    <hr>
                                <div class="row">
                                        <div class="col-12">
                                            <small>Jenis Pertanyaan : <span class="badge badge-warning">`+type+`</span></small>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">ID</label>
                                                <div class="col-sm-10">
                                                <input type="text" class="form-control" placeholder="masukan id unique untuk pertanyaan ini">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label"><small>Pertanyaan</small></label>
                                                    <div class="col-sm-10">
                                                    <textarea class="form-control" placeholder="masukan pertanyaan disini"></textarea>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                        </div>`;
        }

        function template_pilgan(type){
            return `<div>
                    <hr>
                                <div class="row">
                                        <div class="col-12">
                                            <small>Jenis Pertanyaan : <span class="badge badge-primary">`+type+`</span></small>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">ID</label>
                                                <div class="col-sm-10">
                                                <input type="text" class="form-control" placeholder="masukan id unique untuk pertanyaan ini">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label"><small>Pertanyaan</small></label>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" placeholder="masukan pertanyaan disini"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label"><small>Pilihan Jawaban <button class="btn btn-sm btn-primary" onclick="addPilihan(this);"><i class="fa fa-plus"></i></button>
                                                        <button class="btn btn-sm btn-warning" onclick="removePilihan(this);"><i class="fa fa-minus"></i></button>
                                                    </small></label>
                                                    <div class="col-sm-10" id="konten-pilihan">
                                                        <input class="form-control" placeholder="masukan pilihan jawaban"/>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                        </div>`;
        }
        var mutiple_answer = ['checkbox','radio','select'];
        $(document).ready(function(ev){
           $("#btn-add-group button").on('click',function(e){
                let tipe = $(this).data('type');
                if(mutiple_answer.includes(tipe)){
                    $("#kolom").append(template_pilgan(tipe));
                }else{
                    $("#kolom").append(template_text(tipe));
                }
           });
        });
    </script>
@endpush