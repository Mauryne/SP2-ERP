<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 ml-8 mt-4">
            <!-- Goals -->
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <!-- Title -->
                            <h4 class="card-header-title ml-auto">
                                Clients
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
                            <a href="{{route('customers.create')}}" class="btn btn-group-sm btn-white">
                                +
                            </a>

                        </div>

                    </div> <!-- / .row -->

                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                        <tr>
                            <th class="text-muted list-sort" wire:click="sortBy('name')"
                                style="text-align: center; cursor: pointer;">
                                <a>Nom</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('address')"
                                style="text-align: center; cursor: pointer;">
                                <a>Adresse</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('telephoneNumber')"
                                style="text-align: center; cursor: pointer;">
                                <a>N° de téléphone</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('email')"
                                style="text-align: center; cursor: pointer;">
                                <a>Adresse mail</a>
                            </th>
                            <th class="text-muted list-sort" style="text-align: center; cursor: pointer;">
                                <a>Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($customers as $customer)
                            <tr>
                                <td class="tables-name"
                                    style="text-align: center">{{$customer->name}}</td>
                                <td class="tables-email"
                                    style="text-align: center">{{$customer->streetNumber}} {{$customer->street}} {{$customer->postalCode}} {{$customer->city}}</td>
                                <td class="tables-telephoneNumber"
                                    style="text-align: center">{{$customer->telephoneNumber}}</td>
                                <td class="tables-role"
                                    style="text-align: center">{{$customer->email}}</td>
                                <td class="tables-update" style="text-align: center">
                                    <a href="{{route('customers.edit', $customer->id )}}" type="button"
                                       class="fe fe-edit btn btn-sm btn-secondary">
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="float: right">
                {{ $customers->links() }}
            </div>
        </div>
    </div>
</div>

