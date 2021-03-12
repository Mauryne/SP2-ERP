@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Carte') }}</div>

                    <div class="embed-responsive embed-responsive-21by9 rounded">
                        <div class="embed-responsive-item" data-toggle="map" data-options='{"center": [-118.244615, 34.052979], "zoom": 12}'></div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
