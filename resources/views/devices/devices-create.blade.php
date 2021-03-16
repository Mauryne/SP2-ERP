@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-4">
        <div class="row justify-content-center">
            <div class="card col-sm-6 mt-4">
                <div class="card-body">
                    <form action="{{route('devices.store')}}; upload" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="type">Type de matériel : </label>
                            <select name="type" id="type" class="custom-select" data-toggle="select">
                                @foreach($types as $oneType)
                                    <option value="{{$oneType->id}}">{{$oneType->characteristics}}</option>
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
                                   id="europeanNormPicture"/>
                            {{--                        <div class="custom-file">--}}
                            {{--                            <input type="file" name="europeanNormPicture" class="custom-file-input @error('europeanNormPicture') is-invalid @enderror" id="validatedCustomFile">--}}
                            {{--                            <label class="custom-file-label" for="validatedCustomFile">Choisir une image...</label>--}}
                            {{--                            @error('europeanNormPicture')--}}
                            {{--                            <div class="invalid-feedback">{{ $errors->first('europeanNormPicture') }}</div>--}}
                            {{--                            @enderror--}}
                            {{--                        </div>--}}
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

                        <div class="form-group">
                            <label for="customer">Propriétaire du matériel : </label>
                            <select name="customer" id="customer" class="custom-select" data-toggle="select">
                                @foreach($customers as $oneCustomer)
                                    <option value="{{$oneCustomer->id}}">{{$oneCustomer->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" id="saleDate">
                            <label for="saleDate">Date de vente : </label>
                            <input type="date" name="saleDate" id="saleDate" class="form-control">
                        </div>

                        <div class="form-group" id="installationDate">
                            <label for="installationDate">Date d'installation : </label>
                            <input type="date" name="installationDate" id="installationDate"
                                   class="form-control">
                        </div>

                        <div class="form-group" id="installationPicture">
                            <label for="installationPicture">Photo de l'installation : </label>
                            <input type="file" name="image" id="image" value="">
                        </div>

                        <div class="form-group" id="contract">
                            <label for="contract">Durée du contrat : </label>
                            <input type="number" name="contract" min="0" max="5" class="form-control"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="technician">Qui a installé ce matériel ? </label>
                            <select name="technician" id="technician" class="custom-select" data-toggle="select">
                                @foreach($users as $oneTechnician)
                                    <option value="{{$oneTechnician->id}}">{{$oneTechnician->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @csrf()
                        <input type="submit" class="btn btn-group-sm btn-white">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        $('#europeanNormPicture').hide();
        $('#customer').hide();
        $('#saleDate').hide();
        $('#installationDate').hide();
        $('#installationPicture').hide();
        $('#technician').hide();
        $('#contract').hide();

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
            } else {
            }
        }
    </script>
@endsection
