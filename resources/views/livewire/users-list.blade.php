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
                                Utilisateurs
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
                            <a href="{{route('users.create')}}" class="btn btn-group-sm btn-white">
                                +
                            </a>

                        </div>

                    </div> <!-- / .row -->

                </div>

                <div class="table-responsive">
                    <table class="table table-sm table-nowrap card-table">
                        <thead>
                        <tr>
                            <th class="text-muted list-sort" wire:click="sortBy('lastName')"
                                style="text-align: center; cursor: pointer;">
                                <a>Nom</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('email')"
                                style="text-align: center; cursor: pointer;">
                                <a>Adresse mail</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('telephoneNumber')"
                                style="text-align: center; cursor: pointer;">
                                <a>N° de téléphone</a>
                            </th>
                            <th class="text-muted list-sort" wire:click="sortBy('role_id')"
                                style="text-align: center; cursor: pointer;">
                                <a>Rôle</a>
                            </th>
                            <th class="text-muted list-sort" style="text-align: center; cursor: pointer;">
                                <a>Action</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="list">
                        @foreach($users as $user)
                            <tr>
                                <td class="tables-name"
                                    style="text-align: center">{{$user->lastName}} {{$user->firstName}}</td>
                                <td class="tables-email"
                                    style="text-align: center">{{$user->email}}</td>
                                <td class="tables-telephoneNumber"
                                    style="text-align: center">{{$user->telephoneNumber}}</td>
                                <td class="tables-role"
                                    style="text-align: center">{{$user->role->name}}</td>
                                <td class="tables-update" style="text-align: center">
                                    @if($user->id == $authenticate->id || $authenticate->role->name == "Administrateur")
                                        <a href="{{route('users.edit', $user->id )}}" type="button"
                                           class="btn btn-sm btn-info"><span class="fe fe-edit"/>
                                        </a>
                                    @endif
                                    @if($user->id != $authenticate->id && $authenticate->role->name == "Administrateur")
                                        <form action="{{route('users.destroy',$user->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><span class="fe fe-trash-2"/></button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div style="float: right">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>

