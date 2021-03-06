@extends('account._layout')

@section('active_link','survey')
@section('content_account')
<div class="card">
        <div class="card-header"><i class="fa fa-users"></i> Form Maintainer</div>
        <div class="card-body">
        <p class="text-justify"> daftar pengguna yang memiliki akses ke survey <strong>{{$form->name}}</strong></p>
        <hr>
        <div class="text-right">
            <button type="button" class="btn btn-primary mb-2 btn-sm" id="btn-add"><i class="fa fa-plus"></i> Invite new User</button>
        </div>
        <ul class="list-group">
        @foreach($formMaintainer as $user)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="maintainer-role">
                    {{$user->name}} 
                    @if($user->pivot->status == 1)
                    @switch($user->pivot->maintainer_roles_id)
                        @case(1)
                                <span class="badge badge-warning">Creator</span>
                            @break
                        @case(2)
                                <span class="badge badge-danger">Administrator</span>
                            @break
                        @case(3)
                            <span class="badge badge-primary">Member</span>
                        @break
                    @default
                            
                    @endswitch
                    @else
                        <span class="badge badge-secondary">Invited</span>
                    @endif
                </span>
                <span>
                    @if($user->id !== \Auth::user()->id)
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-danger btn-remove" data-id="{{$user->id}}" data-nama="{{\Auth::user()->name}}"><i class="fa fa-trash"></i></button>
                        @if($user->pivot->status == 1)
                            @if($user->pivot->maintainer_roles_id == 2)
                                <button type="button" class="btn btn-primary btn-promotion" data-id="{{$user->id}}" data-promotion-type="down"><i class="fa fa-arrow-down"></i></button>
                            @else
                                <button type="button" class="btn btn-warning btn-promotion" data-id="{{$user->id}}" data-promotion-type="up"><i class="fa fa-arrow-up"></i></button>
                            @endif
                        @endif
                      </div>
                      @else
                      You
                      @endif
                </span>
            </li>
        @endforeach
          </ul>

        <div class="d-flex justify-content-center mt-2">
            {{$formMaintainer->render()}}
        </div>
        </div>
    </div>
@endsection

@push('css-top')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css" />
@endpush
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script>
        $(document).ready(function(ev){
            $("#btn-add").click(function(e){
                Swal.fire({
                title: 'Invite User',
                html:
                '<input type="email" id="form-add-email" class="swal2-input" autofocus placeholder="john@example.com">' +
                `<select id="form-add-level" class="swal2-input">
                    <option value="2">Administrator</option>
                    <option value="3" selected>Member</option>
                </select>`,
                showCancelButton: true,
                confirmButtonText: 'Invite!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                    if (true) {
                        resolve([
                        $('#form-add-email').val(),
                        $('#form-add-level').val()
                        ]);
                    }
                    });
                },
                allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    console.log(result);
                    let email = result.value[0];
                    let role = result.value[1];
                    console.log(email,role);
                    $.ajax({
                        type: "POST",
                        url: "{{route('account.survey.maintainer.add',[$form->id])}}",
                        data: {"email":email, "role":role},
                        dataType: "json",
                        success: function (response) {
                            Swal.fire({
                                'title': response.title,
                                'html':response.html,
                                'type':response.type
                            });
                        }
                    });
                })
            });
            $(document).on('click','.btn-remove',function(e){
                let triger = $(this);
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Anda ingin menhapus user dari Survey ini?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Delete it!'
                }).then((result) => {
                        $.ajax({
                            type: "POST",
                            url: "{{route('account.survey.maintainer.remove',[$form->id])}}",
                            data: {"user_id": id,"nama" : nama},
                            dataType: "json",
                            success: function (response) {
                                Swal.fire({
                                    'title': response.title,
                                    'html':response.html,
                                    'type':response.type
                                });   
                            }
                        });
                    })
            });
            $(document).on('click','.btn-promotion',function(e){
                let id = $(this).data('id');
                let tipe = $(this).data('promotion-type');
                let THEBUTTON = $(this);
                Swal.fire({
                    title: 'Are you sure?',
                    text: (tipe == 'up' ? 'Promoting user to Administrator ? ' : 'Demoting user to member ?'),
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, ' + (tipe == 'up' ? 'Promote' : 'Demote')
                }).then((result) => {
                        if (result.value) {
                            $.ajax({
                            type: "POST",
                            url: "{{route('account.survey.maintainer.promotion',[$form->id])}}",
                            data: {'id':id,'type':tipe},
                            dataType: "json",
                            beforeSend: function(){
                                //Swal.showLoading()
                                Swal.fire({
                                    allowOutsideClick: false,
                                    title: (tipe == 'up' ? 'Promoting user to Administrator' : 'Demoting user to member'),
                                    html: 'Please wait..'
                                });
                    },
                    success: function (response) {
                        if(response.type == 'success'){
                            Swal.fire({
                                type: 'success',
                                title: 'Berhasil',
                                text: response.msg,
                                showConfirmButton: true,
                                //timer: 1500
                            })
                            if(tipe == 'up'){
                                THEBUTTON.data('promotion-type','down');
                                THEBUTTON.removeClass('btn-warning btn-primary').addClass('btn-primary');
                                
                                THEBUTTON.parent().parent().parent().find('#maintainer-role > span').first().html('Administrator').removeClass('badge-danger badge-primary').addClass('badge-danger');
                                THEBUTTON.find('i').first().removeClass('fa-arrow-down fa-arrow-up').addClass('fa-arrow-down');
                            }else{
                                THEBUTTON.data('promotion-type','up');
                                THEBUTTON.removeClass('btn-primary btn-warning').addClass('btn-warning');
                                THEBUTTON.parent().parent().parent().find('#maintainer-role > span').first().html('Member').removeClass('badge-danger badge-primary').addClass('badge-primary');
                                THEBUTTON.find('i').first().removeClass('fa-arrow-down fa-arrow-up').addClass('fa-arrow-up');
                            }
                        }else{
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: response.msg,
                            });
                        }
                        
                    },error: function (){
                        //Swal.close();
                        Swal.fire({
                            type: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!',
                        });
                    }
                });
                        }
                    })
                
                console.log(tipe);
                
            })
        });
    </script>
@endpush