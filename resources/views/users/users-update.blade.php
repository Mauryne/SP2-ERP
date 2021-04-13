@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-6">
        <div class="row justify-content-center">
            <div class="card col-sm-6 mt-5">
                <div class="card-body">
                    <form action="{{route('users.update', $user->id )}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="col-6">
                                <label for="lastName">Nom : </label>
                                <input type="text" name="lastName" class="form-control" placeholder="Nom"
                                       value="{{$user['lastName']}}" required>
                            </div>
                            <div class="col-6 mt-auto">
                                <input type="text" name="firstName" class="form-control" placeholder="Prénom"
                                       value="{{$user['firstName']}}" required>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label for="email">Adresse mail : </label>
                            <input type="email" name="email" class="form-control" placeholder="nom@adresse.com"
                                   value="{{$user['email']}}" required>
                        </div>

                        <div class="form-group">
                            <label for="telephoneNumber">Numéro de téléphone : </label>
                            <input type="text" name="telephoneNumber" class="form-control"
                                   value="{{$user['telephoneNumber']}}" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Rôle : </label>
                            <select name="role" id="role" class="form-control" required>
                                @foreach($roles as $role)
                                    @if($user['role_id'] == $role['id'])
                                        <option selected="selected" value="{{$role['id']}}">{{$role['name']}}</option>
                                    @else
                                        <option value="{{$role['id']}}">{{$role['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @csrf()
                        @method('post')
                        <input name="submit" id="submit" type="submit" class="btn btn-group-sm btn-secondary mt-2">
                        <button formaction="{{route('users.password.edit', $user['id'] )}}" class="btn btn-group-sm btn-secondary mt-2">Modifier le mot de passe</button>
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

        $('select').on('submit', function () {
            $('#e1').val($('#e1').val().join(','));
        });
    </script>
@endsection


