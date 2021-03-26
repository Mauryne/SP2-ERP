<div class="container-fluid">
    <div class="row justify-content-center ml-2">
        <div class="col-md-10 ml-8 mt-4">
            <!-- Goals -->
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h4 class="card-header-title ml-auto">
                                Équipements
                            </h4>
                        </div>

                        {{-- Recherche uniquement par les champs de la table Device (serialNumber, productReference, saleDate)--}}
                        <div class="col-md ml-auto">
                            <label for="query" class="sr-only">Search</label>
                            <input wire:model.debounce.300ms="search" class="form-control" type="text"
                                   placeholder="Recherche">
                        </div>

                        <div class="col-auto mt-3 ml-auto">
                            <h4>Colonnes affichables :</h4>
                        </div>

                        <div class="col-auto ml-auto">
                            <select wire:model.lazy="perPage" class="custom-select form-select-sm w-auto">
                                @for($i = 5; $i <= 25; $i += 5)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-auto ml-auto">

                            <!-- Button -->
                            <a href="{{route('devices.create')}}" class="btn btn-group-sm btn-white">
                                +
                            </a>

                        </div>

                    </div> <!-- / .row -->

                </div>

                {{-- Tri correct par les champs de la table Device (serialNumber, productReference, saleDate) MAIS incorrect pour les champs des autres tables -> tri par id et non alphabétique (ou vide ou non)--}}
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                        <tr>
                            <th class="text-muted list-sort" wire:click="sortBy('type_id')"
                                style="text-align: center; cursor: pointer;">
                                <a>Type</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('serialNumber')"
                                style="text-align: center; cursor: pointer;">
                                <a>Numéro de série</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('productReference')"
                                style="text-align: center; cursor: pointer;">
                                <a>Référence</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('europeanNorm_id')"
                                style="text-align: center; cursor: pointer;">
                                <a>Norme européenne ?</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('customer_id')"
                                style="text-align: center; cursor: pointer;">
                                <a>Nom du client</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('customer_id')"
                                style="text-align: center; cursor: pointer;">
                                <a>Adresse</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('saleDate')"
                                style="text-align: center; cursor: pointer;">
                                <a>Date de vente</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('installation_id')"
                                style="text-align: center; cursor: pointer;">
                                <a>Installation</a>
                            </th>
                            <th class="text-muted list-sort" style="text-align: center; cursor: pointer;">
                                <a>Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($devices as $device)
                            <tr>
                                <td class="tables-type"
                                    style="text-align: center">{{$device->type->characteristics}}</td>
                                <td class="tables-serialNumber"
                                    style="text-align: center">{{$device->serialNumber}}</td>
                                <td class="tables-productReference"
                                    style="text-align: center">{{$device->productReference}}</td>
                                @if($device->europeanNorm_id != null)
                                    <td class="tables-europeanNorm" style="text-align: center">
                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                                data-bs-target="#europeanNormPicture">
                                            Voir la photo
                                        </button>

                                        <div class="modal fade" id="europeanNormPicture" tabindex="-1"
                                             aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Photo de la norme européenne</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img
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
                                    </td>
                                @else
                                    <td class="tables-europeanNorm" style="text-align: center">/</td>
                                @endif

                                @if($device->customer_id != null)
                                    <td class="tables-customer"
                                        style="text-align: center">{{$device->customer->name}}</td>
                                    <td class="tables-city" style="text-align: center">
                                        <a style="text-align: center; color: #6E84A3"
                                           href="{{route('devices.map', $device->customer_id)}}">{{$device->customer->streetNumber}} {{$device->customer->street}} {{$device->customer->city}} {{$device->customer->postalCode}}</a>
                                    </td>
                                    <td class="tables-saleDate"
                                        style="text-align: center">{{ \Carbon\Carbon::parse($device->saleDate)->format('d-m-Y')}}</td>
                                @else
                                    <td class="tables-customer" style="text-align: center">/</td>
                                    <td class="tables-city" style="text-align: center">/</td>
                                    <td class="tables-saleDate" style="text-align: center">/</td>
                                @endif

                                @if($device->installation_id != null)
                                    <td class="tables-installation col-auto" style="text-align: center">
                                        <div style="float: left; text-align: center" class="text ml-2 mt-2">
                                            {{ \Carbon\Carbon::parse($device->installation->date)->format('d-m-Y')}}
                                            - {{$device->installation->user->lastName}} {{$device->installation->user->firstName}}
                                        </div>
                                        <div style="float: right" class="button mt-1">
                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#installationPicture">
                                                Voir la photo
                                            </button>
                                        </div>

                                        <div class="modal fade" id="installationPicture" tabindex="-1"
                                             aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Photo de l'installation</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img
                                                            src="{{asset('storage/'.$device->installation->picture_path)}}"
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
                                    </td>
                                @else
                                    <td class="tables-installation" style="text-align: center">/</td>
                                @endif
                                <td class="tables-update" style="text-align: center">
                                    <a href="{{route('devices.update', $device->id )}}" type="button" class="fe fe-edit btn btn-sm btn-secondary">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="float: right ">
                {{ $devices->links() }}
            </div>
        </div>
    </div>
</div>
@section('js')
    <script>
        function closeModal() {
            $('#exampleModal').modal('hide');
        }

        feather.replace();
    </script>
@endsection
