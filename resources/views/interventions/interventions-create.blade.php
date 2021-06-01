@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-6">
        <div class="row justify-content-center">
            <div class="card col-auto mt-5">
                <div class="card-body">
                    <form action="{{route('interventions.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="device">Matériel : </label>
                            <select name="device" id="device" class="form-control" required>
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
                                   class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="externalProvider">Prestataire extérieur ? </label>
                            <input type="radio" value="1"
                                   id="hasExternalProvider"
                                   name="externalProvider" required>
                            <label for="europeanNorm">Oui</label>
                            <input type="radio" value="0"
                                   id="hasNotExternalProvider"
                                   name="externalProvider" required>
                            <label for="externalProvider">Non</label>
                        </div>

                        <div class="form-group">
                            <label for="billing">Mode de facturation : </label>
                            <select id="billing" name="billing" class="form-control" data-toggle="select" required>
                                @foreach($billings as $billing)
                                    <option value="{{$billing['type']}}">{{$billing['type']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="comment">Commentaire : </label>
                            <input type="text" name="comment" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="device">Technicien(s) : </label>
                            <select id="user" name="user[]" class="form-control" data-toggle="select" multiple required>
                                @foreach($users as $user)
                                    <option value="{{$user['id']}}">{{$user['lastName']}} {{$user['firstName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        @csrf()
                        <input name="submit" id="submit" type="submit" class="btn btn-group-sm btn-secondary mt-2">
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

        $('select').on('submit', function(){
            $('#e1').val($('#e1').val().join(','));
        });
    </script>
@endsection


