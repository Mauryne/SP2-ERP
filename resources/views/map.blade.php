@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-7">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">{{ __('Carte des installations') }}</div>
                        <div id='map' style='width: auto; height: 694px;'></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoibWF1cnluZWxlbWFyY2hhbmQiLCJhIjoiY2toYnA2aGJoMWc0czJ4bnF0ZzBxdWFseCJ9.2OMLj4JIL0MwGLfNrk1IkQ';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [12.550343, 55.665957],
            zoom: 8
        });

        // Add zoom and rotation controls to the map.
        map.addControl(new mapboxgl.NavigationControl());

        // Boucle à faire ici en fonction des points de vente
        var marker = new mapboxgl.Marker()
            .setLngLat([12.550343, 55.665957])
            .addTo(map);

        var marker1 = new mapboxgl.Marker()
            .setLngLat([13.1910073, 55.7046601])
            .addTo(map);
    </script>
@endsection
