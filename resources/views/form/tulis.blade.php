@extends('index')

@include('plugins.ajax-form')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Informasi Survey</div>
                    <div class="card-body">
                        <div class="d-flex justify-content-start">
                            <h5 class="display-5">Name :&nbsp</h5>
                            <h5 class="display-5">{{$form->name}}</h5>
                        </div>
                        <p class="text-justify">{{$form->description}}</p>
                    </div>
                </div>
            </div>

            
            <div class="col-md-12 mt-2">
                <form action="{{route('survey.write.save',[$form->id])}}" data-form-ajax='true' data-reset='true'>
                    <div class="card">
                        <div class="card-header">Formulir Pertanyaan</div>
                        <div class="card-body">
                            @foreach ($form->column as $i => $kolom)
                                <div class="form-group">
                                    <label for="kolom-{{$kolom->id}}">{{$i + 1}}. {{$kolom->pertanyaan}}</label>
                                    @switch($kolom->type)
                                        @case('text')
                                            <input type="text" class="form-control" id="kolom-{{$kolom->id}}" name="jawaban[ke-{{$kolom->id}}]" required="">
                                            @break
                                        @case('textarea')
                                            <textarea class="form-control" id="kolom-{{$kolom->id}}" name="jawaban[ke-{{$kolom->id}}]" required=""></textarea>
                                            @break
                                        @case('checkbox')
                                            <div class="form-check ml-4">
                                                    @foreach ($kolom->pilgan as $item)
                                                    <label class="form-check-label" for="pilgan-{{$item->id}}">
                                                    <input class="form-check-input" type="checkbox" name="jawaban[ke-{{$kolom->id}}][]" id="pilgan-{{$item->id}}" value="{{$item->id}}">{{$item->text}}
                                                    </label><br/>
                                                @endforeach
                                            </div>
                                            @break
                                        @case('radio')
                                            <div class="form-check ml-4">
                                                @foreach ($kolom->pilgan as $item)
                                                <label class="form-check-label" for="pilgan-{{$item->id}}">
                                                <input class="form-check-input" type="radio" name="jawaban[ke-{{$kolom->id}}][]" id="pilgan-{{$item->id}}" value="{{$item->id}}" required>{{$item->text}}
                                                </label><br/>
                                            @endforeach
                                            </div>
                                        @break

                                        @case('select')
                                        <div class="form-group ml-4">
                                                <select name="jawaban[ke-{{$kolom->id}}][]" class="form-control" required>
                                                        <option value="" disabled selected>--</option>
                                                        @foreach ($kolom->pilgan as $item)
                                                            <option value="{{$item->id}}">{{$item->text}}</option> 
                                                        @endforeach
                                                    </select>
                                        </div>
                                        @break
                                            
                                        @default
                                            
                                    @endswitch
                                </div>
                                
                            @endforeach
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            

            
        </div>
    </div>
@endsection