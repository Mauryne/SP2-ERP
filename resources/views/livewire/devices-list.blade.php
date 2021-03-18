<div class="container-fluid">
    <div class="row justify-content-center ml-2">
        <div class="col-md-9 ml-8 mt-4">
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
                                        <button type="button" class="btn btn-sm btn-white mt-2" data-toggle="modal" data-target="#exampleModal">
                                            Voir la photo
                                        </button>
                                    </td>
                                @else
                                    <td class="tables-europeanNorm" style="text-align: center">/</td>
                                @endif

                                @if($device->customer_id != null)
                                    <td class="tables-customer"
                                        style="text-align: center">{{$device->customer->name}}</td>
                                    <td class="tables-city" style="text-align: center">
                                        <a style="text-align: center; color: #7687A3"
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
                                        {{ \Carbon\Carbon::parse($device->installation->date)->format('d-m-Y')}}
                                        - {{$device->installation->user->name}}
                                        <a style="text-align: center" href="{{$device->installation->picture_path}}"
                                           class="btn btn-sm btn-white ml-2">Voir
                                            la photo</a>
                                    </td>

                                @else
                                    <td class="tables-installation" style="text-align: center">/</td>
                                @endif
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
