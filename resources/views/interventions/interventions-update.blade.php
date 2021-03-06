@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-6">
        <div class="row justify-content-center">
            <div class="card col-auto mt-5">
                <div class="card-body">
                    <form action="{{route('interventions.update', $intervention->id )}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="device">Matériel : </label>
                            <select name="device" id="device" class="form-control" required>
                                @foreach($devices as $device)
                                    @if($intervention->device_id == $device->id)
                                        <option selected="selected" value="{{$device->id}}">{{$device->serialNumber}}
                                            - {{$device->productReference}}</option>
                                    @else
                                        <option value="{{$device->id}}">{{$device->serialNumber}}
                                            - {{$device->productReference}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-row">
                            <div class="col-auto mr-3">
                                <label for="address">Adresse : </label>
                                <input value="{{$intervention->streetNumber}}" placeholder="numéro de rue" type="text"
                                       name="streetNumber" class="form-control"
                                       required>
                            </div>
                            <div class="col-auto mt-auto mr-3">
                                <input value="{{$intervention->street}}" placeholder="rue" type="text" name="street"
                                       class="form-control" required>
                            </div>
                            <div class="col-auto mt-auto mr-3">
                                <input value="{{$intervention->city}}" placeholder="ville" type="text" name="city"
                                       class="form-control" required>
                            </div>
                            <div class="col-auto mt-auto">
                                <input value="{{$intervention->postalCode}}" placeholder="code postal" type="text"
                                       name="postalCode" class="form-control"
                                       required>
                            </div>
                        </div>

                        <div class="form-group mt-3" id="date">
                            <label for="date">Date : </label>
                            <input value="{{$intervention->date}}" type="date" name="date" id="date"
                                   class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="externalProvider">Prestataire extérieur ? </label>
                            @if($intervention->externalProvider == 1)
                                <input type="radio" value="1"
                                       id="hasExternalProvider" checked="checked"
                                       name="externalProvider" required>
                                <label for="europeanNorm">Oui</label>
                                <input type="radio" value="0"
                                       id="hasNotExternalProvider"
                                       name="externalProvider" required>
                                <label for="externalProvider">Non</label>
                            @else
                                <input type="radio" value="1"
                                       id="hasExternalProvider"
                                       name="externalProvider" required>
                                <label for="europeanNorm">Oui</label>
                                <input type="radio" value="0"
                                       id="hasNotExternalProvider" checked="checked"
                                       name="externalProvider" required>
                                <label for="externalProvider">Non</label>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="billing">Mode de facturation : </label>
                            <select id="billing" name="billing" class="form-control" data-toggle="select" required>
                            @foreach($billings as $billing)
                                @if($billing->maintenance_id == $intervention->id))
                                    <option selected="selected"
                                            value="{{$billing['type']}}">{{$billing['type']}}</option>
                                @else
                                    <option
                                        value="{{$billing['type']}}">{{$billing['type']}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-5">
                            <label for="comment">Commentaire : </label>
                            <input value="{{$intervention->comment}}" type="text" name="comment" class="form-control"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="device">Technicien(s) : </label>
                            <select id="user" name="user[]" class="form-control" data-toggle="select"
                                    multiple="multiple" required>
                                @foreach($users as $user)
                                    @if($intervention->users()->get()->contains($user['id']))
                                        <option selected="selected"
                                                value="{{$user['id']}}">{{$user['lastName']}} {{$user['firstName']}}</option>
                                    @else
                                        <option
                                            value="{{$user['id']}}">{{$user['lastName']}} {{$user['firstName']}}</option>
                                    @endif
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
    </script>
@endsection


