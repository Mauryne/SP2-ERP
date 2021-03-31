@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-6">
        <div class="row justify-content-center">
            <div class="card col-sm-6 mt-5">
                <div class="card-body">
                    <form action="#" method="POST">
                        @csrf()
                        @method('PUT')
                        <div class="form-group">
                            <label for="type">Type de matériel : </label>
                            <select name="type" id="type" class="form-control">
                                @foreach($types as $oneType)
                                    @if($device->type == $oneType)
                                        <option selected="selected"
                                                value="{{$oneType->id}}">{{$oneType->characteristics}}</option>
                                    @else
                                        <option
                                            value="{{$oneType->id}}">{{$oneType->characteristics}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Numéro de série :</label>
                            <input type="text" name="name" id="name" value="{{$device->serialNumber}}"
                                   class="form-control"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="name">Référence du produit :</label>
                            <input type="text" name="name" id="name" value="{{$device->productReference}}"
                                   class="form-control"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="europeanNorm">Norme européenne ? </label>
                            @if($device->europeanNorm_id != null)
                                <input onclick="showPictureEuropeanNorm()" type="radio" checked="checked"
                                       value="1"
                                       id="isEuropeanNorm"
                                       name="europeanNorm">
                                <label for="europeanNorm">Oui</label>
                                <input onclick="hidePictureEuropeanNorm()" type="radio" value="0"
                                       id="isNotEuropeanNorm"
                                       name="europeanNorm">
                                <label for="europeanNorm">Non</label>
                            @elseif($device->europeanNorm_id == null)
                                <input onclick="showPictureEuropeanNorm()" type="radio" value="1"
                                       id="isEuropeanNorm"
                                       name="europeanNorm">
                                <label for="europeanNorm">Oui</label>
                                <input onclick="hidePictureEuropeanNorm()" type="radio" checked="checked"
                                       value="0"
                                       id="isNotEuropeanNorm"
                                       name="europeanNorm">
                                <label for="europeanNorm">Non</label>
                            @endif
                        </div>
                        <div class="form-group" id="europeanNormPicture">
                            <label for="europeanNormPicture">Photo de la plaquette CE
                                : </label>
                            @if($device->europeanNorm_id != null)
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#europeanNormPicture">Voir la photo
                                </button>

                                <div class="modal fade" tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Photo de la norme européenne</h4>
                                            </div>
                                            <div class="modal-body">
                                                <img id="picEuropeanNorm"
                                                     src="{{asset('storage')}}/{{$device->europeanNorm->picture_path}}"
                                                     width="500" height="350">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Fermer
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--                                --}}
                                {{--                                --}}
                                {{--                                <img src="{{asset('storage')}}/{{$device->europeanNorm->picture_path}}" width="50" height="35"/>--}}
                                {{--                                <button class="btn btn-secondary">Modifier</button>--}}
                                {{--                                <button class="btn btn-secondary">Supprimer</button>--}}
                            @else
                                <input type="text" name="europeanNormPicture"
                                       class="form-control">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="available">Est-il disponible ? </label>
                            @if($device->customer_id == null)
                                <input onclick="hideAvailable()" type="radio" checked="checked" value="1"
                                       id="isAvailable"
                                       name="available">
                                <label for="available">Oui</label>
                                <input onclick="showAvailable()" type="radio" value="0" id="isNotAvailable"
                                       name="available">
                                <label for="available">Non</label>
                            @elseif($device->customer_id != null)
                                <input onclick="hideAvailable()" type="radio" value="1" id="isAvailable"
                                       name="available">
                                <label for="available">Oui</label>
                                <input onclick="showAvailable(); getValues()" type="radio" checked="checked" value="0"
                                       id="isNotAvailable"
                                       name="available">
                                <label for="available">Non</label>
                            @endif
                        </div>
                        <div class="form-group" id="customer">
                            <label for="customer">Propriétaire du matériel : </label>
                            <br>
                            <select name="customer" id="customer" class="custom-select"
                                    data-toggle="select">
                                @foreach($customers as $oneCustomer)
                                    @if($device->customer == $oneCustomer)
                                        <option selected="selected"
                                                value="{{$oneCustomer->id}}">{{$oneCustomer->name}}</option>
                                    @else
                                        <option value="{{$oneCustomer->id}}">{{$oneCustomer->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="saleDate">
                            <label for="saleDate">Date de vente : </label>
                            <input type="date" name="saleDate" id="saleDate" value="{{$device->saleDate}}"
                                   class="form-control">
                        </div>

                        <div class="form-group" id="installationDate">
                            <label for="installationDate">Date d'installation : </label>
                            @if($device->installation_id != null)
                                <input type="date" name="installationDate" value="{{$device->installation->date}}"
                                       id="installationDate" class="form-control">
                            @else
                                <input type="date" name="installationDate" value=""
                                       id="installationDate" class="form-control">
                            @endif
                        </div>

                        <div class="form-group" id="installationPicture">
                            <label for="installationPicture">Photo de l'installation
                                : </label>
                            @if($device->installation_id != null)
                                <img src="{{public_path($device->installation->picture_path)}}"/>
                                <button class="btn btn-secondary">Modifier</button>
                                <button class="btn btn-secondary">Supprimer</button>
                            @else
                                <input type="file" name="installationPicture"
                                       id="installationPicture">
                            @endif
                        </div>

                        <div class="form-group" id="installationSummary">
                            <label for="installationSummary">Commentaire de
                                l'installation : </label>
                            @if($device->installation_id != null)
                                <input type="text" name="installationSummary" value="{{$device->installation->summary}}"
                                       class="form-control">
                            @else
                                <input type="text" name="installationSummary"
                                       class="form-control">
                            @endif
                        </div>

                        <div class="form-group" id="guarantee">
                            <label for="guarantee">Durée de la garantie : </label>
                            @if($device->guarantee_id != null)
                                <input type="number" name="guarantee" min="0" max="10"
                                       value="{{$device->guarantee->initialDuration}}"
                                       class="form-control">
                            @else
                                <input type="number" name="guarantee" min="0" max="10"
                                       class="form-control">
                            @endif
                        </div>

                        <div class="form-group" id="technician">
                            <label for="technician">Qui a installé ce matériel
                                ? </label>
                            <br>
                            <select name="technician" id="technician"
                                    class="custom-select" data-toggle="select">
                                @foreach($users as $oneTechnician)
                                    @if($device->installation_id != null)
                                        @if($device->installation->user == $oneTechnician)
                                            <option selected="selected"
                                                    value="{{$oneTechnician->id}}">{{$oneTechnician->lastName}} {{$oneTechnician->firstName}}</option>
                                        @else
                                            <option
                                                value="{{$oneTechnician->id}}">{{$oneTechnician->lastName}} {{$oneTechnician->firstName}}</option>
                                        @endif
                                    @endif
                                    <option
                                        value="{{$oneTechnician->id}}">{{$oneTechnician->lastName}} {{$oneTechnician->firstName}}</option>
                                @endforeach
                            </select>
                        </div>
                        @csrf()
                        <input type="submit" class="btn btn-secondary">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function closeModal() {
            $('#exampleModal').modal('hide');
        }

        $(document).ready(function () {
            if ($('#isEuropeanNorm').prop('checked')) {
                $('#europeanNormPicture').show();
            } else {
            }
        });

        $(document).ready(function () {
            if ($('#isNotAvailable').prop('checked')) {
                $('#customer').show();
                $('#saleDate').show();
                $('#installationDate').show();
                $('#installationPicture').show();
                $('#technician').show();
                $('#installationSummary').show();
                $('#guarantee').show();
            } else {
            }
        });

        $('#europeanNormPicture').hide();
        $('#customer').hide();
        $('#saleDate').hide();
        $('#installationDate').hide();
        $('#installationPicture').hide();
        $('#technician').hide();
        $('#installationSummary').hide();
        $('#guarantee').hide();

        function showPictureEuropeanNorm() {
            if ($('#isEuropeanNorm').prop('checked')) {
                $('#europeanNormPicture').show();
            } else {
            }
        }

        function hidePictureEuropeanNorm() {
            if ($('#isNotEuropeanNorm').prop('checked')) {
                $('#europeanNormPicture').hide();
            } else {
            }
        }

        function hideAvailable() {
            if ($('#isAvailable').prop('checked')) {
                $('#customer').hide();
                $('#saleDate').hide();
                $('#installationDate').hide();
                $('#installationPicture').hide();
                $('#technician').hide();
                $('#installationSummary').hide();
                $('#guarantee').hide();
            } else {
            }
        }

        function showAvailable() {
            if ($('#isNotAvailable').prop('checked')) {
                $('#customer').show();
                $('#saleDate').show();
                $('#installationDate').show();
                $('#installationPicture').show();
                $('#technician').show();
                $('#installationSummary').show();
                $('#guarantee').show();
            } else {
            }
        }
    </script>
@endsection
