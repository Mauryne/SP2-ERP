@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-6">
        <div class="row justify-content-center">
            <div class="card col-sm-6 mt-5">
                <div class="card-body">
                    <form action="{{route('users.password.update', $user->id )}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                                <label for="password">Nouveau mot de passe : </label>
                            <div class="input-group input-group-merge">

                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password" required
                                       autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="confirmation">Confirmer le nouveau mot de passe : </label>
                            <div class="input-group input-group-merge">

                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password" required
                                       autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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

        $('select').on('submit', function () {
            $('#e1').val($('#e1').val().join(','));
        });
    </script>
@endsection


