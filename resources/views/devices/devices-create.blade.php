@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-6">
        <div class="row justify-content-center">
            <div class="card col-sm-6 mt-5">
                <div class="card-body">
                    <form id="form" action="{{route('devices.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type de matériel : </label>
                            <select name="type" id="type" class="form-control">
                                @foreach($types as $oneType)
                                    <option value="{{$oneType['id']}}">{{$oneType['characteristics']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="serialNumber">Numéro de série : </label>
                            <input type="text" name="serialNumber" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="productReference">Référence du matériel : </label>
                            <input type="text" name="productReference" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="europeanNorm">Norme européenne ? </label>
                            <input onclick="showPictureEuropeanNorm()" type="radio" value="1"
                                   id="isEuropeanNorm"
                                   name="europeanNorm" required>
                            <label for="europeanNorm">Oui</label>
                            <input onclick="hidePictureEuropeanNorm()" type="radio" value="0"
                                   id="isNotEuropeanNorm"
                                   name="europeanNorm" required>
                            <label for="europeanNorm">Non</label>
                        </div>


                        <div class="form-group" id="europeanNormPicture">
                            <label for="europeanNormPicture">Photo de la plaquette CE : </label>
                            <input type="file" class="form-control" name="europeanNormPicture"
                                   id="anEuropeanNormPicture" accept=".jpg, .jpeg, .png"/>
                        </div>

                        <div class="form-group">
                            <label for="available">Est-il disponible ? </label>
                            <input onclick="hideAvailable()" type="radio" value="1" id="isAvailable"
                                   name="available"
                                   required>
                            <label for="available">Oui</label>
                            <input onclick="showAvailable()" type="radio" value="0" id="isNotAvailable"
                                   name="available"
                                   required>
                            <label for="available">Non</label>
                        </div>

                        <div class="form-group" id="customer">
                            <label for="customer">Propriétaire du matériel : </label>
                            <select name="customer" id="customer" class="custom-select" data-toggle="select">
                                @foreach($customers as $oneCustomer)
                                    <option value="{{$oneCustomer['id']}}">{{$oneCustomer['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="saleDate">
                            <label for="saleDate">Date de vente : </label>
                            <input type="date" name="saleDate" id="aSaleDate" class="form-control">
                        </div>

                        <div class="form-group" id="installationDate">
                            <label for="installationDate">Date d'installation : </label>
                            <input type="date" name="installationDate" id="anInstallationDate"
                                   class="form-control">
                        </div>

                        <div class="form-group" id="installationPicture">
                            <label for="installationPicture">Photo de l'installation : </label>
                            <input type="file" name="installationPicture" id="anInstallationPicture">
                        </div>

                        <div class="form-group" id="installationSummary">
                            <label for="installationSummary">Commentaire de l'installation : </label>
                            <input type="text" name="installationSummary" id="anInstallationSummary" class="form-control">
                        </div>

                        <div class="form-group" id="contract">
                            <label for="contract">Durée du contrat : </label>
                            <input type="number" id="aContract" name="contract" min="0" max="5" class="form-control">
                        </div>

                        <div class="form-group" id="guarantee">
                            <label for="guarantee">Durée de la garantie : </label>
                            <input type="number" id="aGuarantee" name="guarantee" min="0" max="10" class="form-control">
                        </div>

                        <div class="form-group" id="technician">
                            <label for="technician">Qui a installé ce matériel ? </label>
                            <select name="technician" id="technician" class="custom-select" data-toggle="select">
                                @foreach($users as $oneTechnician)
                                    <option value="{{$oneTechnician['id']}}">{{$oneTechnician['lastName']}} {{$oneTechnician['firstName']}}</option>
                                @endforeach
                            </select>
                        </div>
                        @csrf()
                        <input onclick="return validateForm()" type="submit" class="btn btn-secondary">
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
                $('#saleDate').show();
                $('#installationDate').show();
                $('#installationPicture').show();
                $('#technician').show();
                $('#contract').show();
                $('#installationSummary').show();
                $('#guarantee').show();
            } else {
            }
        }

        function validateForm() {
            if ($('#isEuropeanNorm').prop('checked')) {
                var europeanNormPicture = document.forms["form"]["anEuropeanNormPicture"].value;
                if (europeanNormPicture == null || europeanNormPicture === "") {
                    alert("Veuillez choisir une image valide.");
                    return false;
                }
            }

            var saleDate = document.getElementById("aSaleDate");
            var installationDate = document.getElementById("anInstallationDate");
            var summary = document.getElementById("anInstallationSummary");
            var contract = document.getElementById("aContract");
            var guarantee = document.getElementById("aGuarantee");

            if ($('#isNotAvailable').prop('checked')) {
                var installationPicture = document.forms["form"]["anInstallationPicture"].value;
                if (installationPicture == null || installationPicture === "") {
                    alert("Veuillez choisir une image valide.");
                    return false;
                }
                saleDate.setAttribute('required', 'required');
                installationDate.setAttribute('required', 'required');
                summary.setAttribute('required', 'required');
                contract.setAttribute('required', 'required');
                guarantee.setAttribute('required', 'required');
            } else if(($('#isAvailable').prop('checked'))) {
                saleDate.removeAttribute('required');
                installationDate.removeAttribute('required');
                summary.removeAttribute('required');
                contract.removeAttribute('required');
                guarantee.removeAttribute('required');
            }
        }
    </script>
@endsection
