@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Liste des Activités'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="{{ route('activites.create') }}" class="btn btn-primary">Ajouter une Activité</a>
                </div>

                @if(session('success'))
                    <div id="success-alert" class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div id="error-alert" class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <script>
                    setTimeout(function() {
                        var successAlert = document.getElementById('success-alert');
                        var errorAlert = document.getElementById('error-alert');
                        if (successAlert) {
                            successAlert.style.display = 'none';
                        }
                        if (errorAlert) {
                            errorAlert.style.display = 'none';
                        }
                    }, 3000);
                </script>

                <!-- Search Form -->
                <div class="card-body px-0 pt-0 pb-2">
                    <form action="{{ route('activites.list') }}" method="GET" class="mb-3">
                        <input type="text" name="search" value="{{ request()->input('search') }}" placeholder="Rechercher..." class="form-control" />
                        <button type="submit" class="btn btn-primary mt-2">Chercher</button>
                    </form>

                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lieu</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activites as $activite)
                                    <tr>
                                        <td>{{ $activite->nom }}</td>
                                        <td>{{ Str::limit($activite->description, 50) }}</td>
                                        <td>{{ $activite->date }}</td>
                                        <td>{{ $activite->lieu }}</td>
                                        <td class="align-middle text-end">
                                            <a href="{{ route('activites.show', $activite->id) }}" class="btn btn-info">Voir</a>
                                            <a href="{{ route('activites.edit', $activite->id) }}" class="btn btn-warning">Modifier</a>

                                            <form action="{{ route('activites.destroy', $activite->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        {{ $activites->links() }}
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
@endsection