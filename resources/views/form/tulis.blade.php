@extends('index')

@include('plugins.ajax-form')
@include('plugins.geolocation')
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Informasi Survey</span>
                            <span>s</span>
                        </div>
                    </div>
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
                    <input type="hidden" name="geolocation[lat]" value="" id="geo-lat">
                    <input type="hidden" name="geolocation[long]" value="" id="geo-long">
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

@push('scripts')
<script>

    $(document).ready(function(ev){
        function loadingLocation(){
                loaderLocation = Swal.fire({
                allowOutsideClick: false,
                title: 'Detecting Location!',
                html: 'this popup will closed until your location is detected<br/><span id="location-loader"></span>',
                onBeforeOpen: () => {
                    Swal.showLoading()
                }
                });
        }

        function changePos(position){
            console.log(position);
            $("form #geo-lat").val(position.coords.latitude);
            $("form #geo-long").val(position.coords.longitude);
            
            $("#location-loader").html("location detected ! : " + position.coords.latitude + ', ' + position.coords.longitude);
            messs = loaderLocation;
            var interVal = setTimeout(function(){
                try {
                    Swal.close();
                } catch (error) {
                    //console.log(error.message);  
                }
                clearTimeout(interVal);
            },1000);
        }

        function errorPos(error){
            switch(error.code) {
                case error.PERMISSION_DENIED:
                alert("User denied the request for Geolocation.");
                break;
                case error.POSITION_UNAVAILABLE:
                alert("Location information is unavailable.");
                break;
                case error.TIMEOUT:
                alert("The request to get user location timed out.");
                break;
                case error.UNKNOWN_ERROR:
                alert("An unknown error occurred.");
                break;
            }
        }

        loadingLocation();
        getLocation(changePos, errorPos);
        
        var geoWatcher = navigator.geolocation.watchPosition(changePos, errorPos, null);
    });
</script>
@endpush