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
                            <input type="file" class="form-control"
                                   name="europeanNormPicture"
                                   id="europeanNormPicture"/>
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
                                <input onclick="showAvailable()" type="radio" checked="checked" value="0"
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
                            <input type="date" name="saleDate" id="saleDate" value=""
                                   class="form-control">
                        </div>

                        <div class="form-group" id="installationDate">
                            <label for="installationDate">Date d'installation : </label>
                            <input type="date" name="installationDate"
                                   id="installationDate" value=""
                                   class="form-control">
                        </div>

                        <div class="form-group" id="installationPicture">
                            <label for="installationPicture">Photo de l'installation
                                : </label>
                            <input type="file" name="installationPicture"
                                   id="installationPicture">
                        </div>

                        <div class="form-group" id="installationSummary">
                            <label for="installationSummary">Commentaire de
                                l'installation : </label>
                            <input type="text" name="installationSummary" value=""
                                   class="form-control">
                        </div>

                        <div class="form-group" id="contract">
                            <label for="contract">Durée du contrat : </label>
                            <input type="number" name="contract" min="0" max="5"
                                   value=""
                                   class="form-control">
                        </div>

                        <div class="form-group" id="guarantee">
                            <label for="guarantee">Durée de la garantie : </label>
                            <input type="number" name="guarantee" min="0" max="10"
                                   value=""
                                   class="form-control">
                        </div>

                        <div class="form-group" id="technician">
                            <label for="technician">Qui a installé ce matériel
                                ? </label>
                            <br>
                            <select name="technician" id="technician"
                                    class="custom-select" data-toggle="select">
                                @foreach($users as $oneTechnician)
                                    @if($device->installation->user == $oneTechnician)
                                        <option selected="selected"
                                                value="{{$oneTechnician->id}}">{{$oneTechnician->lastName}} {{$oneTechnician->firstName}}</option>
                                    @else
                                        <option
                                            value="{{$oneTechnician->id}}">{{$oneTechnician->lastName}} {{$oneTechnician->firstName}}</option>
                                    @endif
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
                $('#contract').show();
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
        $('#contract').hide();
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
                $('#contract').hide();
                $('#installationSummary').hide();
                $('#guarantee').hide();
            } else {
            }
        }

        function showAvailable() {
            if ($('#isNotAvailable').prop('checked')) {
                $('#customer').show();
                $('#saleDate').show().val({{$device->saleDate}});
                $('#installationDate').show().val({{$device->installation->date}});
                $('#installationPicture').show();
                $('#technician').show();
                $('#contract').show().val({{$device->contract->initialDuration}});
                $('#installationSummary').show().val({{$device->installation->summary}});
                $('#guarantee').show().val({{$device->guarantee->initialDuration}});
            } else {
            }
        }
    </script>
@endsection
