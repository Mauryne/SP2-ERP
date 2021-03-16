@extends('layouts.app')

@section('content')
    <div class="ml-auto" id='map' style='width: 1670px; height: 938px;'></div>
    <span id="query"
          hidden> {{$intervention->streetNumber}} {{$intervention->street}} {{$intervention->city}} {{$intervention->postalCode}}  </span>
@endsection
@section('js')
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoidG9tODU1NTYwIiwiYSI6ImNraGJwZTZuYjFnOWIyd25xMGtrcWxna2gifQ.-CQ_HgTajdodccqfWAXjww';
        var mapboxClient = mapboxSdk({accessToken: mapboxgl.accessToken});
        mapboxClient.geocoding
            .forwardGeocode({

                query: document.getElementById('query').innerHTML,

                autocomplete: false,
                limit: 4
            })
            .send()
            .then(function (response) {
                if (
                    response &&
                    response.body &&
                    response.body.features &&
                    response.body.features.length
                ) {
                    var feature = response.body.features[0];

                    var map = new mapboxgl.Map({
                        container: 'map',
                        style: 'mapbox://styles/mapbox/streets-v11',
                        center: feature.center,
                        zoom: 10
                    });
                    new mapboxgl.Marker()
                        .setLngLat(feature.center)
                        .addTo(map);
                    map.addControl(new mapboxgl.NavigationControl());
                }
            });
    </script>
@endsection
