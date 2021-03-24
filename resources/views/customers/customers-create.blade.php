@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-6">
        <div class="row justify-content-center">
            <div class="card col-sm-6 mt-5">
                <div class="card-body">
                    <form action="{{route('customers.store')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nom : </label>
                            <input type="text" name="name" class="form-control" required>
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

                        <div class="form-group mt-3">
                            <label for="telephoneNumber">Numéro de téléphone : </label>
                            <input type="text" name="telephoneNumber" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Adresse mail : </label>
                            <input type="email" name="email" class="form-control" placeholder="nom@adresse.com" required>
                        </div>
                        @csrf()
                        <input name="submit" id="submit" type="submit" class="btn btn-group-sm btn-white mt-2">
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


