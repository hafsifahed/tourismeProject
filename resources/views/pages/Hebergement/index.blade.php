@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Liste des hebergements'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="{{ route('hebergement.create') }}" class="btn btn-primary">Ajouter une accommodations</a>
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

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Region</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Addresse</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prix >Nuit </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accommodations as $accommodation)
                                    <tr>
                                        <td>{{ $accommodation->name }}</td>
                                        <td>{{ $accommodation->type }}</td>
                                        <td>{{ $accommodation->region }}</td>
                                        <td>{{ $accommodation->address }}</td>
                                        <td>{{ $accommodation->price_per_night }}</td>
                                        <td class="align-middle text-end">
                                            <a href="{{ route('hebergement.show', $accommodation->id) }}" class="btn btn-info">Voir</a>
                                            <a href="{{ route('hebergement.edit', $accommodation->id) }}" class="btn btn-warning">Modifier</a>

                                            <form action="{{ route('hebergement.destroy', $accommodation->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                      
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
@endsection