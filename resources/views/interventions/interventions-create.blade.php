@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-6">
        <div class="row justify-content-center">
            <div class="card col-sm-6 mt-5">
                <div class="card-body">
                    <form action="{{route('interventions.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="device">Matériel : </label>
                            <select name="device" id="device">
                                @foreach($devices as $device)
                                    <option value="{{$device->id}}">{{$device->serialNumber}}
                                        - {{$device->productReference}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="col-auto mr-3">
                                <label for="address">Adresse : </label>
                                <input placeholder="numéro de rue" type="text" name="streetNumber" class="form-control"
                                       required>
                            </div>
                            <div class="col-auto mt-auto mr-3">
                                <input placeholder="rue" type="text" name="street" class="form-control" required>
                            </div>
                            <div class="col-auto mt-auto mr-3">
                                <input placeholder="ville" type="text" name="city" class="form-control" required>
                            </div>
                            <div class="col-auto mt-auto">
                                <input placeholder="code postal" type="text" name="postalCode" class="form-control"
                                       required>
                            </div>
                        </div>

                        <div class="form-group mt-3" id="date">
                            <label for="date">Date : </label>
                            <input type="date" name="date" id="date"
                                   class="form-control">
                        </div>

                        <select id="user" name="user" class="form-control" data-toggle="select" multiple>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        @csrf()
                        <input type="submit" class="btn btn-group-sm btn-white mt-2">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('select').select2({
            allowClear: true
        });
    </script>
@endsection


