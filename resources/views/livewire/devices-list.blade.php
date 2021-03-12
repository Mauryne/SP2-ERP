<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Goals -->
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h4 class="card-header-title">
                                Équipements
                            </h4>
                        </div>

                        {{-- Recherche uniquement par les champs de la table Device (serialNumber, productReference, saleDate)--}}
                        <div class="col-auto">
                            <label for="query" class="sr-only">Search</label>
                            <input wire:model.debounce.300ms="search" class="form-control" type="text"
                                   placeholder="Recherche">
                        </div>

                        <div class="col-auto mt-3">
                            <h4>Colonnes affichables :</h4>
                        </div>

                        <div class="col-auto">
                            <select wire:model.lazy="perPage" class="custom-select form-select-sm w-auto">
                                @for($i = 5; $i <= 25; $i += 5)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-auto">

                            <!-- Button -->
                            <a href="#!" class="btn btn-group-sm btn-white">
                                +
                            </a>

                        </div>

                    </div> <!-- / .row -->

                </div>

                {{-- Tri uniquement par les champs de la table Device (serialNumber, productReference, saleDate)--}}
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                        <tr>
                            <th class="text-muted list-sort" style="text-align: center; cursor: pointer;">
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
                            <th class="text-muted list-sort" style="text-align: center; cursor: pointer;">
                                <a>Norme européenne ?</a>
                            </th>
                            <th class="text-muted list-sort" style="text-align: center; cursor: pointer;">
                                <a>Nom du client</a>
                            </th>
                            <th class="text-muted list-sort" style="text-align: center; cursor: pointer;">
                                <a>Adresse</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('saleDate')"
                                style="text-align: center; cursor: pointer;">
                                <a>Date de vente</a>
                            </th>
                            <th class="text-muted list-sort" style="text-align: center; cursor: pointer;">
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
                                        <a style="text-align: center" href="{{$device->europeanNorm->picture}}" class="btn btn-sm btn-white mt-2">Voir la photo</a>
                                    </td>
                                @else
                                    <td class="tables-europeanNorm" style="text-align: center">/</td>
                                @endif

                                @if($device->customer_id != null)
                                    <td class="tables-customer"
                                        style="text-align: center">{{$device->customer->name}}</td>
                                    <td class="tables-address"
                                        style="text-align: center">{{$device->customer->streetNumber}} {{$device->customer->street}} {{$device->customer->city}} {{$device->customer->postalCode}}</td>
                                    <td class="tables-saleDate" style="text-align: center">{{ \Carbon\Carbon::parse($device->saleDate)->format('d/m/Y')}}</td>
                                @else
                                    <td class="tables-customer" style="text-align: center">/</td>
                                    <td class="tables-address" style="text-align: center">/</td>
                                    <td class="tables-saleDate" style="text-align: center">/</td>
                                @endif

                                @if($device->installation_id != null)
                                    <td class="tables-installation" style="text-align: center">
                                        {{ \Carbon\Carbon::parse($device->installation->date)->format('d/m/Y')}}
                                        - {{$device->installation->user->name}}
                                        <br>
                                        <a style="text-align: center" href="{{$device->installation->picture}}" class="btn btn-sm btn-white mt-2">Voir
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
            <div>
                {{ $devices->links() }}
            </div>
        </div>
    </div>
</div>
