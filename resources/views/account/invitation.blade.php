@extends('account._layout')

@section('active_link','invitation')
@section('content_account')
<div class="card">
        <div class="card-header">
            <span class="d-flex justify-content-between align-items-center">
                <span><i class="fa fa-envelope"></i> Invitation</span>
            </span>
        </div>
        <!--<div class="card-body">
            <div class="row">
                @foreach($invitations as $survey)
                    <div class="col-md-6 col-sm-12">
                            <div class="card mt-2">
                                <div class="card-body">
                                <h5 class="card-title">{{$survey->name}}</h5>
                                    <h6 class="card-subtitle mb-2">
                                    <div class="d-flex justify-content-between">
                                            <div class="small">
                                                    @foreach ($survey->getFormUserRoleData() as $r)
                                                    {!! $r->badge() !!}
                                                @endforeach
                                            </div>
                                            
                                    <small class="text-muted">{{ isset($survey->content) ? $survey->content->count() : '0'}} Responden</small>
                                    </div>
                                    </h6>
                                    <p class="card-text">{{$survey->description}}</p>
                                    <div class="d-flex justify-content-end">
                                        <div>
                                                <a href="{!! $survey->link() !!}" class="card-link text-primary"><i class="fa fa-link"></i></a>
                                                @if(in_array($survey->pivot->maintainer_roles_id,[1,2]))
                                                    <a href="{!! $survey->mapsLink() !!}" class="card-link text-warning"><i class="fa fa-map"></i></a>    
                                                    <a href="#" class="card-link text-danger"><i class="fa fa-wrench"></i></a>
                                                    <a href="#" class="card-link text-success"><i class="fa fa-tachometer-alt"></i></a>
                                                @endif
                                                @if($survey->pivot->maintainer_roles_id == 1 || $survey->pivot->maintainer_roles_id == 1)
                                            <a href="{{route('account.survey.maintainer.index',[$survey->id])}}" class="card-link text-dark"><i class="fa fa-users"></i></a>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>-->
        <ul class="list-group">
        @foreach($invitations as $user)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span id="maintainer-role">
                    {{$user->name}} 
                    @if($user->pivot->status == 0)
                        <span class="badge badge-secondary">Invited</span>
                    @endif
                </span>
                <span>
                    @if($user->id !== \Auth::user()->id)
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-danger btn-remove" data-id="{{$user->pivot->id}}" data-nama="{{\Auth::user()->name}}"><i class="fa fa-trash"></i></button>
                        @if($user->pivot->maintainer_roles_id == 0)
                            <button type="button" class="btn btn-warning btn-add" data-id="{{$user->pivot->id}}" data-promotion-type="up"><i class="fa fa-plus"></i></button>
                        @endif
                      </div>
                      @else
                      You
                      @endif
                </span>
            </li>
        @endforeach
          </ul>
</div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script>
        $(document).ready(function(ev){
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
                        url: "{{route('account.invitation.remove')}}",
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
                });
            });
            $(document).on('click','.btn-add',function(e){
                let id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'received this survey',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            url: '{{route('account.invitation.save')}}',
                            data: {'id':id},
                            dataType: "json",
                            beforeSend: function(){
                                //Swal.showLoading()
                                Swal.fire({
                                    allowOutsideClick: false,
                                    title: "Verification invited survey",
                                    html: 'Please wait..'
                                });
                            },
                            success: function (response) {
                                if(response.status == 'success'){
                                    Swal.fire({
                                        type: 'success',
                                        title: 'Berhasil',
                                        text: response.msg,
                                        showConfirmButton: true,
                                        //timer: 1500
                                    })
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
                });               
                console.log(tipe);
            })
        });
    </script>
@endpush