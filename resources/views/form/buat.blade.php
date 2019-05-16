@extends('index')

@include('plugins.ajax-form')
@section('content')
<style>
.enemete{
    transition: 0.25ms all ease-in-out;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{route('account.survey.store')}}" data-form-ajax='true' data-reset='true'>
                    <fieldset>
                            <div class="card">
                                    <div class="card-header">Buat Survey Baru</div>
                    
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="name">Nama Survey</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama Survey" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Deskripsi Survey</label>
                                            <textarea class="form-control" id="description" name="description" placeholder="Nama Survey" required></textarea>
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
                    </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        function addPilihan(trig,unique_id){
            var pr = $(trig).parent().parent().parent().parent();
            console.log(pr);
            pr.find('#konten-pilihan').append(`<input name="pilihan_jawaban[`+unique_id+`][]" class="form-control mt-1 enemete" placeholder="masukan pilihan jawaban" required/>`);
        }

        function removePilihan(trig){
            var pr = $(trig).parent().parent().parent().parent();
            var inputs = pr.find('#konten-pilihan input');
            if(inputs.length > 1) inputs.last().remove();
        }

        function makeid(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }

        function template_text(type,unique_id){
            return `<div>
                    <hr>
                                <div class="row survey-form-container">
                                        <input type="hidden" name="type[`+unique_id+`]" value="`+type+`">
                                        <div class="col-12 judul-pertanyaan">
                                            
                                                    <small>Jenis Pertanyaan : <span class="badge badge-warning">`+type+`</span>
                                                     | 
                                                    <a href="javascript:void(0);" class="text-danger delete-pertanyaan"><i class="fa fa-trash"></i><span>Hapus</span></a>
                                                </small>
                                            
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">ID</label>
                                                <div class="col-sm-10">
                                                <input type="text" name="id[`+unique_id+`]" class="form-control" placeholder="masukan id unique untuk pertanyaan ini">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label"><small>Pertanyaan</small></label>
                                                    <div class="col-sm-10">
                                                    <textarea name="pertanyaan[`+unique_id+`]" class="form-control" placeholder="masukan pertanyaan disini" required></textarea>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                        </div>`;
        }

        function template_pilgan(type,unique_id){
            return `<div>
                    <hr>
                                <div class="row survey-form-container">
                                        <input type="hidden" name="type[`+unique_id+`]" value="`+type+`">
                                        <div class="col-12 judul-pertanyaan">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <small>Jenis Pertanyaan : <span class="badge badge-warning">`+type+`</span>
                                                        
                                                    </small>
                                                    <div>
                                                    <button type="button" class="btn btn-danger btn-sm delete-pertanyaan"><i class="fa fa-trash"></i></button> 
                                                    
                                                    <button alt="tambah pilihan jawaban" type="button" class="btn btn-sm btn-primary" onclick="addPilihan(this,'`+unique_id+`');"><i class="fa fa-plus"></i></button>
                                                    <button type="button" class="btn btn-sm btn-warning" onclick="removePilihan(this);"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">ID</label>
                                                <div class="col-sm-10">
                                                <input type="text" name="id[`+unique_id+`]" class="form-control" placeholder="masukan id unique untuk pertanyaan ini">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label"><small>Pertanyaan</small></label>
                                                <div class="col-sm-10">
                                                    <textarea name="pertanyaan[`+unique_id+`]" class="form-control" placeholder="masukan pertanyaan disini"  required></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                    <label class="col-sm-2 col-form-label"><small>Pilihan Jawaban 
                                                    </small></label>
                                                    <div class="col-sm-10" id="konten-pilihan">
                                                        <input name="pilihan_jawaban[`+unique_id+`][]" class="form-control" placeholder="masukan pilihan jawaban"/>
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
                    $("#kolom").append(template_pilgan(tipe,makeid(10)));
                }else{
                    $("#kolom").append(template_text(tipe,makeid(10)));
                }
           });

           $(document).on('click','.delete-pertanyaan',function(e){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $(this).parent().parent().parent().parent().remove();
                        Swal.fire(
                        'Deleted!',
                        'Pertanyaan telah dihapus.',
                        'success'
                        )
                    }
                })
                
           });
        });
    </script>
@endpush