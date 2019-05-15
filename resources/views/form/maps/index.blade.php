@extends('index')

@include('plugins.ajax-form')
@include('plugins.geolocation')
@include('plugins.leaflet')
@section('content')
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <span>Sebaran data responden</span>
                            <span>s</span>
                        </div>
                    </div>
                    <div class="card-body">
                            <div id="map" style="height:500px"></div>
                    </div>
                </div>
            </div>

            
    

            
        </div>
    </div>
@endsection

@push('scripts')
<script>
    String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1)
    }
    var data = JSON.parse('{!! json_encode($data) !!}');
    var form = JSON.parse('{!! json_encode($survey) !!}');

    function sumarize(data){
        console.log(form[4]);
        let txt = '';
        $.each(data, function(key, value) {
            txt+= form[key].name.capitalize() + ': ';
            let calon = [];
            if(form[key].is_pilgan){
                value.forEach(el => {
                    calon.push(form[key].pilgan[el]['value']);
                });
            }else{
                txt+= value;
            }
            txt+= calon.join(', ');
            txt+= "<br>";
        });
        return txt;
    }
    $(document).ready(function(ev){
        var sample = data[Math.floor(Math.random() * data.length + 1)];
        console.log(sample);
        var map = L.map('map').setView([sample.lat, sample.long], 11);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

/*        L.marker([51.5, -0.09]).addTo(map)
            .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
            .openPopup();*/
        data.forEach(c => {
            sumarize(c.content);
            L.marker([c.lat, c.long]).addTo(map).bindPopup(sumarize(c.content) + '\nSubmited by ' + c.author);
        });
    });
</script>
@endpush