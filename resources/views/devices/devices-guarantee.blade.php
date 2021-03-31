@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-6">
        <div class="row justify-content-center">
            <div class="card col-sm-6 mt-5">
                <div class="card-body">
                    <div class="form-group">
                        <label for="initialDurationGuarantee">Durée initiale de la garantie : </label>
                        @if($device->guarantee->initialDuration > 1)
                        <input type="text" name="initialDurationGuarantee"
                               value="{{$device->guarantee->initialDuration}} ans" class="form-control" readonly>
                            @else
                            <input type="text" name="initialDurationGuarantee"
                                   value="{{$device->guarantee->initialDuration}} an" class="form-control" readonly>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="name">Liste des renouvellements de la garantie : </label>
                        <div class="container mt-4">
                            <div class="row align-items-start">
                                <div class="col" style="text-align: center">Durée</div>
                                <div class="col" style="text-align: center">Date de signature</div>
                            </div>
                            <form id="form">
                                @foreach($renewalsGuarantee as $renewalGuarantee)
                                    @if($renewalGuarantee->guarantee_id == $device->guarantee_id)
                                        <div class="form-row">
                                            <div class="col mt-2">
                                                @if($renewalGuarantee->duration > 1)
                                                <input type="text" name="renewalGuaranteeDuration"
                                                       id="renewalGuaranteeDuration"
                                                       value="{{$renewalGuarantee->duration}} ans"
                                                       class="form-control" style="text-align: center" readonly>
                                                    @else
                                                    <input type="text" name="renewalGuaranteeDuration"
                                                           id="renewalGuaranteeDuration"
                                                           value="{{$renewalGuarantee->duration}} an"
                                                           class="form-control" style="text-align: center" readonly>
                                                @endif
                                            </div>
                                            <div class="col mt-2">
                                                <input type="date" name="renewalGuaranteeDate" id="renewalGuaranteeDate"
                                                       value="{{$renewalGuarantee->signatureDate}}"
                                                       class="form-control" style="text-align: center" readonly>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </form>
                        </div>
                        <a onclick="addLine()" type="button" id="button" class="btn btn-secondary mt-4"> Ajouter un
                            renouvellement de la garantie</a>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('js')
            <script>
                function addLine() {

                    var form = document.getElementById("form");
                    form.setAttribute('method', 'post');
                    form.setAttribute('action', "{{route('guarantees.store')}}");

                    var token = document.createElement("input");
                    token.setAttribute("type","hidden");
                    token.setAttribute("name","_token");
                    token.setAttribute("value","{{csrf_token()}}");

                    form.appendChild(token);

                    var guarantee = document.createElement('input');
                    guarantee.setAttribute('type', 'hidden');
                    guarantee.setAttribute('name', 'guarantee');
                    guarantee.setAttribute('value', "{{$device->guarantee_id}}");

                    var principalDiv = document.createElement('div');
                    principalDiv.setAttribute('class', 'form-row');

                    var otherDivDuration = document.createElement('div');
                    otherDivDuration.setAttribute('class', 'col mt-2');

                    var otherDivDate = document.createElement('div');
                    otherDivDate.setAttribute('class', 'col mt-2');

                    var inputDuration = document.createElement('input');
                    inputDuration.setAttribute('id', 'renewalGuaranteeDuration');
                    inputDuration.setAttribute('name', 'renewalGuaranteeDuration');
                    inputDuration.setAttribute('class', 'form-control');
                    inputDuration.setAttribute('style', 'text-align: center');
                    inputDuration.setAttribute('type', 'number');
                   // inputDuration.required = true;

                    var inputDate = document.createElement('input');
                    inputDate.setAttribute('id', 'renewalGuaranteeDate');
                    inputDate.setAttribute('name', 'renewalGuaranteeDate');
                    inputDate.setAttribute('class', 'form-control');
                    inputDate.setAttribute('style', 'text-align: center');
                    inputDate.setAttribute('type', 'date');
                    //inputDate.required = true;

                    var button = document.createElement('a');
                    button.setAttribute('class', 'btn btn-success mt-2 float-right');
                    button.innerHTML = 'Valider';
                    button.setAttribute('onclick', "document.getElementById('form').submit(); return false;");

                    form.appendChild(principalDiv);
                    principalDiv.appendChild(guarantee);

                    principalDiv.appendChild(otherDivDuration);
                    otherDivDuration.appendChild(inputDuration);

                    principalDiv.appendChild(otherDivDate);
                    otherDivDate.appendChild(inputDate);

                    otherDivDate.appendChild(button);
                }
            </script>
@endsection
