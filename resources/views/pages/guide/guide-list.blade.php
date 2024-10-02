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
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type de Guide</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plus d'infos</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($guides as $guide)
                                <tr>
                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <img src="{{ $guide->image_url }}" alt="{{ $guide->nom }}" class="avatar" style="border-radius: 200px;">
                                            <div class="d-flex flex-column justify-content-center" style="margin-left: 20px">
                                                <h6 class="mb-0 text-sm">
                                                    <a href="{{ route('guidelocal.show', $guide->id) }}" class="text-decoration-none text-primary">
                                                        {{ $guide->nom }}
                                                    </a>
                                                </h6>
                                                <p class="text-sm text-secondary mb-0">{{ $guide->adresse }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">{{ $guide->ville }}</p>
                                    </td>
                                    <td class="align-middle text-center">
                                        <p class="text-sm font-weight-bold mb-0">{{ $guide->type_guide }}</p>
                                    </td>

                                    <td>
                                        <div class="d-flex px-3 py-1">
                                            <div class="d-flex flex-column justify-content-center" style="margin-left: 20px">
                                                <p class="mb-0 text-sm">{{ $guide->email }}</p>
                                                <p class="text-sm text-secondary mb-0">{{ $guide->telephone }}</p>
                                                <p class="text-sm text-secondary mb-0">
                                                    <a href="{{ $guide->site_web }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">Voir site web</a>
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="align-middle text-end">
                                        <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                            <a href="{{ route('guidelocal.edit', $guide->id) }}" class="text-sm font-weight-bold mb-0" style="color: blue; margin-right: 10px;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form method="POST" action="{{ route('guidelocal.delete', $guide->id) }}" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce guide local ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-weight-bold mb-0" style="background: none; border: none; color: red; cursor: pointer;">
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
                        <div style="margin-left: 50px">
                            {{ $guides->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
