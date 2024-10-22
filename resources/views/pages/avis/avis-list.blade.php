@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Liste des Avis de Tours'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="{{ route('avistour.add') }}" class="btn btn-primary">Ajouter Avis de Tour</a>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom du Guide</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nom de l'Utilisateur</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Note</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Commentaire</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($avis as $avie)
                                <tr>
                                    <td class="text-sm font-weight-bold mb-0">{{ $avie->guideLocal->nom }}</td>
                                    <td class="text-sm font-weight-bold mb-0">{{ App\Models\User::where('id', $avie->utilisateur)->get()[0]["firstname"] }}</td>
                                    <td class="text-center text-sm">{{ $avie->note }}</td>
                                    <td class="text-center text-sm">{{ $avie->commentaire }}</td>
                                    <td class="align-middle text-end">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('avistour.edit', $avie->id) }}" class="text-sm font-weight-bold" style="color: blue; margin-right: 10px;">
                                                <i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </a>
                                            <form method="POST" action="{{ route('avistour.delete', $avie->id) }}" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm font-weight-bold" style="background: none; border: none; color: red; cursor: pointer;">
                                                    <i class="fas fa-trash-alt"></i>
                                                    <span>Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
