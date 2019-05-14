@extends('account._layout')

@section('active_link','survey')
@section('content_account')
<div class="card">
        <div class="card-header"><i class="fa fa-poll"></i> Survey</div>
        <div class="card-body">
            <div class="row">
                @foreach($surveys as $survey)
                    <div class="col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">{{$survey->name}}</h5>
                                    <h6 class="card-subtitle mb-2">
                                    <div class="d-flex justify-content-between">
                                            <div class="small">
                                                    @foreach ($survey->getFormUserRoleData() as $r)
                                                    {!! $r->badge() !!}
                                                @endforeach
                                            </div>
                                            <small class="text-muted">{{$survey->content->count()}} Responden</small>
                                    </div>
                                    </h6>
                                    <p class="card-text">{{$survey->description}}</p>
                                    <div class="d-flex justify-content-end">
                                        <div>
                                                <a href="{!! $survey->link() !!}" class="card-link text-primary"><i class="fa fa-link"></i></a>
                                                @if(in_array($survey->pivot->maintainer_roles_id,[1,2]))
                                                    <a href="#" class="card-link text-warning"><i class="fa fa-map"></i></a>    
                                                    <a href="#" class="card-link text-danger"><i class="fa fa-wrench"></i></a>
                                                    <a href="#" class="card-link text-success"><i class="fa fa-tachometer-alt"></i></a>
                                                @endif
                                                @if($survey->pivot->maintainer_roles_id == 1)
                                                <a href="#" class="card-link text-dark"><i class="fa fa-users"></i></a>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection