@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-6">
        <div class="row justify-content-center">
            <div class="card col-sm-6 mt-5">
                <div class="card-body">
                    <form id="form" action="{{route('devices.update', $device->id )}}" method="post"
                          enctype="multipart/form-data">
                        @csrf()
                        @method('PUT')
                        <div class="form-group">
                            <label for="type">Type de matériel : </label>
                            <select name="type" id="type" class="form-control">
                                @foreach($types as $oneType)
                                    @if($device->type == $oneType)
                                        <option selected="selected"
                                                value="{{$oneType['id']}}">{{$oneType['characteristics']}}</option>
                                    @else
                                        <option
                                            value="{{$oneType['id']}}">{{$oneType['characteristics']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="serialNumber">Numéro de série :</label>
                            <input type="text" name="serialNumber" id="serialNumber" value="{{$device->serialNumber}}"
                                   class="form-control"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="productReference">Référence du produit :</label>
                            <input type="text" name="productReference" id="productReference"
                                   value="{{$device->productReference}}"
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
                                        data-bs-target="#europeanNormPictures">
                                    Voir la photo
                                </button>

                                <div class="modal fade" id="europeanNormPictures" tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Photo de la norme européenne</h4>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{asset('storage')}}/{{$device->europeanNorm->picture_path}}"
                                                     class="img-fluid">
                                                <div class="mt-4" style="text-align: right">
                                                    <a onclick="updateEuropeanNormPicture()"
                                                       id="updateEuropeanNormPicture"
                                                       class="btn btn-secondary">Modifier</a>
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Fermer
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="europeanNormModal" class="modal-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <input type="file" class="form-control" name="europeanNormPicture"
                                       id="anEuropeanNormPicture" accept=".jpg, .jpeg, .png"/>
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
                                                value="{{$oneCustomer['id']}}">{{$oneCustomer['name']}}</option>
                                    @else
                                        <option value="{{$oneCustomer['id']}}">{{$oneCustomer['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="saleDate">
                            <label for="saleDate">Date de vente : </label>
                            <input type="date" name="saleDate" id="aSaleDate" value="{{$device->saleDate}}"
                                   class="form-control">
                        </div>

                        <div class="form-group" id="installationDate">
                            <label for="installationDate">Date d'installation : </label>
                            @if($device->installation_id != null)
                                <input type="date" name="installationDate" value="{{$device->installation->date}}"
                                       id="installationDate" class="form-control" required>
                            @else
                                <input type="date" name="installationDate" value=""
                                       id="anInstallationDate" class="form-control">
                            @endif
                        </div>

                        <div class="form-group" id="installationPicture">
                            <label for="installationPicture">Photo de l'installation
                                : </label>
                            @if($device->installation_id != null)
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#installationPictures">
                                    Voir la photo
                                </button>

                                <div class="modal fade" id="installationPictures" tabindex="-1"
                                     aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Photo de l'installation</h4>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{asset('storage')}}/{{$device->installation->picture_path}}"
                                                     class="img-fluid">
                                                <div class="mt-4" style="text-align: right">
                                                    <a onclick="updateInstallationPicture()"
                                                       id="updateInstallationPicture"
                                                       class="btn btn-secondary">Modifier</a>
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Fermer
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="installationModal" class="modal-footer"></div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <input type="file" class="form-control" name="installationPicture"
                                       id="anInstallationPicture" accept=".jpg, .jpeg, .png"/>
                            @endif
                        </div>

                        <div class="form-group" id="installationSummary">
                            <label for="installationSummary">Commentaire de
                                l'installation : </label>
                            @if($device->installation_id != null)
                                <input type="text" name="installationSummary" value="{{$device->installation->summary}}"
                                       class="form-control" required>
                            @else
                                <input type="text" name="installationSummary" id="anInstallationSummary"
                                       class="form-control">
                            @endif
                        </div>

                        <div class="form-group" id="contract">
                            <label for="contract">Durée du contrat : </label>
                            @if($device->contract_id =! null)
                                <input type="number" id="contract" name="contract" min="0" max="5" class="form-control"
                                       value="{{$device->contract->initialDuration}}" required>
                            @else
                                <input type="number" id="aContract" name="contract" min="0" max="5" class="form-control">
                            @endif
                        </div>

                        <div class="form-group" id="guarantee">
                            <label for="guarantee">Durée de la garantie : </label>
                            @if($device->guarantee_id =! null)
                                <input type="number" id="guarantee" name="guarantee" min="0" max="10"
                                       class="form-control" value="{{$device->guarantee->initialDuration}}" required>
                            @else
                                <input type="number" id="aGuarantee" name="guarantee" min="0" max="10"
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
                                                    value="{{$oneTechnician['id']}}">{{$oneTechnician['lastName']}} {{$oneTechnician['firstName']}}</option>
                                        @else
                                            <option
                                                value="{{$oneTechnician['id']}}">{{$oneTechnician['lastName']}} {{$oneTechnician['firstName']}}</option>
                                        @endif
                                    @else
                                        <option
                                            value="{{$oneTechnician['id']}}">{{$oneTechnician['lastName']}} {{$oneTechnician['firstName']}}</option>
                                    @endif
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
        function closeModal() {
            $('#exampleModal').modal('hide');
        }

        $('select').select2({
            allowClear: true
        });

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
                $('#contract').show();
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
        $('#contract').hide();
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
                $('#contract').hide();
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
                $('#contract').show();
                $('#guarantee').show();
            } else {
            }
        }

        function updateEuropeanNormPicture() {
            var modalFooter = document.getElementById('europeanNormModal');

            var formEuropeanNorm = document.createElement('form');
            formEuropeanNorm.setAttribute('id', 'formEuropeanNorm');
            formEuropeanNorm.setAttribute('class', 'w-100 h-125');
            formEuropeanNorm.setAttribute('method', 'post');
            formEuropeanNorm.setAttribute('enctype', 'multipart/form-data');
            formEuropeanNorm.setAttribute('action', "{{route('europeanNorm.store', $device->id)}}");

            var token = document.createElement("input");
            token.setAttribute("type", "hidden");
            token.setAttribute("name", "_token");
            token.setAttribute("value", "{{csrf_token()}}");

            formEuropeanNorm.appendChild(token);

            var input = document.createElement('input');
            input.setAttribute('class', 'float-left form-control');
            input.setAttribute('type', 'file');
            input.setAttribute('name', 'newEuropeanNormPicture');
            input.setAttribute('id', 'newEuropeanNormPicture');
            input.setAttribute('accept', ".jpg, .jpeg, .png");

            var button = document.createElement('button');
            button.setAttribute('class', 'btn btn-block btn-success float-right mt-4');
            button.innerHTML = 'Valider';
            button.setAttribute('onclick', 'return validateFormEuropeanNorm()');
            button.setAttribute('onsubmit', "document.getElementById('formEuropeanNorm').submit(); return false;");

            modalFooter.appendChild(formEuropeanNorm);
            formEuropeanNorm.appendChild(input);
            formEuropeanNorm.appendChild(button);

            document.getElementById("updateEuropeanNormPicture").removeAttribute('onclick');
        }

        function validateFormEuropeanNorm() {
            var europeanNormPicture = document.forms["formEuropeanNorm"]["newEuropeanNormPicture"].value;

            if (europeanNormPicture == null || europeanNormPicture === "") {
                alert("Veuillez choisir une image valide.");
                return false;
            }
        }

        function updateInstallationPicture() {
            var modalFooter = document.getElementById('installationModal');

            var formInstallation = document.createElement('form');
            formInstallation.setAttribute('id', 'formInstallation');
            formInstallation.setAttribute('class', 'w-100 h-125');
            formInstallation.setAttribute('method', 'post');
            formInstallation.setAttribute('enctype', 'multipart/form-data');
            formInstallation.setAttribute('action', "{{route('installation.store', $device->id)}}");

            var token = document.createElement("input");
            token.setAttribute("type", "hidden");
            token.setAttribute("name", "_token");
            token.setAttribute("value", "{{csrf_token()}}");

            formInstallation.appendChild(token);

            var input = document.createElement('input');
            input.setAttribute('class', 'float-left');
            input.setAttribute('type', 'file');
            input.setAttribute('name', 'newInstallationPicture');
            input.setAttribute('id', 'newInstallationPicture');
            input.setAttribute('accept', ".jpg, .jpeg, .png");

            var button = document.createElement('button');
            button.setAttribute('class', 'btn btn-block btn-success float-right mt-4');
            button.innerHTML = 'Valider';
            button.setAttribute('onclick', 'return validateFormInstallation()');
            button.setAttribute('onsubmit', "document.getElementById('formInstallation').submit(); return false;");

            modalFooter.appendChild(formInstallation);
            formInstallation.appendChild(input);
            formInstallation.appendChild(button);

            document.getElementById("updateInstallationPicture").removeAttribute('onclick');
        }

        function validateFormInstallation() {
            var installationPicture = document.forms["formInstallation"]["newInstallationPicture"].value;

            if (installationPicture == null || installationPicture === "") {
                alert("Veuillez choisir une image valide.");
                return false;
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
