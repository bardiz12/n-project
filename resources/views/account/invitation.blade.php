@extends('account._layout')

@section('active_link','invitation')
@section('content_account')
<div class="card">
        <div class="card-header">
            <span class="d-flex justify-content-between align-items-center">
                <span><i class="fa fa-poll"></i> Survey</span>
                <a href="{{route('account.survey.create')}}" class="btn btn-primary">
                    <span class="d-none d-sm-block" style="display:inherit">
                            <i class="fa fa-plus"></i>
                            Create New Survey
                    </span>
                    <span class="d-xl-none d-lg-none d-md-none">
                            <i class="fa fa-plus"></i>
                            Create
                    </span>
                </a>
            </span>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach($surveys as $survey)
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
        </div>
    </div>
@endsection