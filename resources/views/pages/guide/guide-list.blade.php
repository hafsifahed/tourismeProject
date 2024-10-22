@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Liste des Guides Locaux'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="{{ route('guidelocal.add') }}" class="btn btn-primary">Ajouter Guide Local</a>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ville</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Téléphone</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Site Web</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Description</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($guides as $guide)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/' . $guide->photo_url) }}" alt="{{ $guide->nom }}" class="avatar" style="border-radius: 200px; width: 50px; height: 50px;">
                                            <div class="ms-3">
                                                <h6 class="mb-0 text-sm">
                                                    <a href="{{ route('guidelocal.show', $guide->id) }}" class="text-decoration-none text-primary">
                                                        {{ $guide->nom }}
                                                    </a>
                                                </h6>
                                                <p class="text-sm text-secondary mb-0">{{ $guide->adresse ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-sm font-weight-bold mb-0">{{ $guide->ville }}</td>
                                    <td class="text-center text-sm">{{ $guide->email }}</td>
                                    <td class="text-center text-sm">{{ $guide->telephone }}</td>
                                    <td class="text-center text-sm">
                                        <a href="{{ $guide->site_web }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">Voir site web</a>
                                    </td>
                                    <td class="text-center text-sm">{{ $guide->description ?? 'N/A' }}</td>
                                    <td class="align-middle text-end">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('guidelocal.edit', $guide->id) }}" class="text-sm font-weight-bold" style="color: blue; margin-right: 10px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('guidelocal.delete', $guide->id) }}" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce guide local ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-weight-bold" style="background: none; border: none; color: red; cursor: pointer;">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br/>
                        <div style="margin-left: 50px;">
                            {{ $guides->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
