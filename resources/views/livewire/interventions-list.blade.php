<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-auto ml-8 mt-4">
            <!-- Goals -->
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h4 class="card-header-title ml-auto">
                                Interventions
                            </h4>
                        </div>

                        {{-- Recherche uniquement par les champs de la table Maintenance --}}
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
                            <a href="{{route('interventions.create')}}" class="btn btn-group-sm btn-white">
                                +
                            </a>

                        </div>

                    </div> <!-- / .row -->

                </div>

                {{-- Tri correct par les champs de la table Maintenance MAIS incorrect pour les champs des autres tables -> tri par id et non alphabétique --}}
                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                        <tr>
                            <th class="text-muted list-sort" wire:click="sortBy('device_id')"
                                style="text-align: center; cursor: pointer;">
                                <a>Matériel</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('date')"
                                style="text-align: center; cursor: pointer;">
                                <a>Date</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('city')"
                                style="text-align: center; cursor: pointer;">
                                <a>Adresse</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('id')"
                                style="text-align: center; cursor: pointer;">
                                <a>Technicien(s)</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('externalProvider')"
                                style="text-align: center; cursor: pointer;">
                                <a>Prestataire externe</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('comment')"
                                style="text-align: center; cursor: pointer;">
                                <a>Commentaire</a>
                            </th>
                            <th class="text-muted list-sort" style="text-align: center; cursor: pointer;">
                                <a>Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($interventions as $intervention)
                            <tr>
                                <td class="tables-device"
                                    style="text-align: center">{{$intervention->device->serialNumber}}
                                    - {{$intervention->device->productReference}}</td>
                                <td class="tables-date"
                                    style="text-align: center">{{\Carbon\Carbon::parse($intervention->date)->format('d-m-Y')}}</td>
                                <td class="tables-address"
                                    style="text-align: center"><a style="text-align: center; color: #6E84A3"
                                                                  href="{{route('interventions.map', $intervention->id)}}">{{$intervention->streetNumber}} {{$intervention->street}} {{$intervention->city}} {{$intervention->postalCode}}</a>
                                </td>
                                <td class="tables-user" style="text-align: center">
                                    @foreach($intervention->users as $key => $user)
                                        @if($key !== 0)
                                            ,
                                        @endif
                                        {{$user->lastName}} {{$user->firstName}}
                                    @endforeach
                                </td>
                                @if($intervention->externalProvider == 0)
                                    <td class="tables-externalProvider"
                                        style="text-align: center">Non
                                    </td>
                                @else
                                    <td class="tables-externalProvider"
                                        style="text-align: center">Oui
                                    </td>
                                @endif
                                <td class="tables-comment"
                                    style="text-align: center">{{$intervention->comment}}</td>
                                <td class="tables-update" style="text-align: center">
                                    <a href="{{route('interventions.edit', $intervention->id )}}" type="button"
                                       class="btn btn-sm btn-secondary"><span class="fe fe-edit"/>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="float: right">
                {{ $interventions->links() }}
            </div>
        </div>
    </div>
</div>

