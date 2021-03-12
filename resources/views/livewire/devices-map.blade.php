<div id='map' style='width: auto; height: 869px;'></div>
<span id="query"
      hidden> {{$customer->streetNumber}} {{$customer->street}} {{$customer->city}} {{$customer->postalCode}}  </span>
@push('scripts')
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
@endpush
