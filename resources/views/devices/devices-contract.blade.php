@extends('layouts.app')

@section('content')
    <div class="container-fluid ml-6">
        <div class="row justify-content-center">
            <div class="card col-sm-6 mt-5">
                <div class="card-body">
                    <div class="form-group">
                        <label for="initialDurationContract">Durée initiale du contrat : </label>
                        <input type="text" name="initialDurationContract"
                               value="{{$device->contract->initialDuration}} an(s)" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="name">Liste des renouvellements du contrat : </label>
                        <div class="container mt-4">
                            <div class="row align-items-start">
                                <div class="col" style="text-align: center">Durée</div>
                                <div class="col" style="text-align: center">Date de signature</div>
                            </div>
                            <form id="form">
                                @foreach($renewalsContract as $renewalContract)
                                    @if($renewalContract->contract_id == $device->contract_id)
                                        <div class="form-row">
                                            <div class="col mt-2">
                                                <input type="text" name="renewalContractDuration"
                                                       id="renewalContractDuration"
                                                       value="{{$renewalContract->duration}} an(s)"
                                                       class="form-control" style="text-align: center" readonly>
                                            </div>
                                            <div class="col mt-2">
                                                <input type="date" name="renewalContractDate" id="renewalContractDate"
                                                       value="{{$renewalContract->signatureDate}}"
                                                       class="form-control" style="text-align: center" readonly>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </form>
                        </div>
                        <a onclick="addLine()" type="button" id="button" class="btn btn-secondary mt-4"> Ajouter un
                            renouvellement de contrat</a>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        @section('js')
            <script>
                function addLine() {

                    //code javascript
                    var form = document.getElementById("form");
                    form.setAttribute('method', 'post');
                    form.setAttribute('action', "{{route('contracts.store')}}");

                    var token = document.createElement("input");
                    token.setAttribute("type","hidden");
                    token.setAttribute("name","_token");
                    token.setAttribute("value","{{csrf_token()}}");

                    form.appendChild(token);

                    var contract = document.createElement('input');
                    contract.setAttribute('type', 'hidden');
                    contract.setAttribute('name', 'contract');
                    contract.setAttribute('value', "{{$device->contract_id}}");

                    var principalDiv = document.createElement('div');
                    principalDiv.setAttribute('class', 'form-row');

                    var otherDivDuration = document.createElement('div');
                    otherDivDuration.setAttribute('class', 'col mt-2');

                    var otherDivDate = document.createElement('div');
                    otherDivDate.setAttribute('class', 'col mt-2');

                    var inputDuration = document.createElement('input');
                    inputDuration.setAttribute('id', 'renewalContractDuration');
                    inputDuration.setAttribute('name', 'renewalContractDuration');
                    inputDuration.setAttribute('class', 'form-control');
                    inputDuration.setAttribute('style', 'text-align: center');
                    inputDuration.setAttribute('type', 'number');

                    var inputDate = document.createElement('input');
                    inputDate.setAttribute('id', 'renewalContractDate');
                    inputDate.setAttribute('name', 'renewalContractDate');
                    inputDate.setAttribute('class', 'form-control');
                    inputDate.setAttribute('style', 'text-align: center');
                    inputDate.setAttribute('type', 'date');

                    var button = document.createElement('a');
                    button.setAttribute('class', 'btn btn-success mt-2 float-right');
                    button.innerHTML = 'Valider';
                    button.setAttribute('onclick', "document.getElementById('form').submit(); return false;");

                    form.appendChild(principalDiv);
                    principalDiv.appendChild(contract);

                    principalDiv.appendChild(otherDivDuration);
                    otherDivDuration.appendChild(inputDuration);

                    principalDiv.appendChild(otherDivDate);
                    otherDivDate.appendChild(inputDate);

                    otherDivDate.appendChild(button);
                }

            </script>
@endsection
