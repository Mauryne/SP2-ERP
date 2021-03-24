@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-7">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ __('Carte des ventes') }}</h4></div>
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
            center: [-1.426442, 46.670511],
            zoom: 8
        });

        // Add zoom and rotation controls to the map.
        map.addControl(new mapboxgl.NavigationControl());

        let sales = {!! json_encode($sales) !!}
        sales.forEach(sale =>
        {
            var marker = new mapboxgl.Marker()
                .setLngLat([sale.longitude, sale.latitude])
                .addTo(map);
        });
    </script>
@endsection
