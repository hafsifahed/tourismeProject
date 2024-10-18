@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Détails du Restaurant'])

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-header ">
                        <h2 class="mb-0">{{ $restaurant->nom }}</h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Adresse:</strong> {{ $restaurant->adresse }}</p>
                                <p><strong>Ville:</strong> {{ $restaurant->ville }}</p>
                                <p><strong>Code Postal:</strong> {{ $restaurant->code_postal }}</p>
                                <p><strong>Téléphone:</strong> {{ $restaurant->telephone }}</p>
                                <p><strong>Email:</strong> <a href="mailto:{{ $restaurant->email }}">{{ $restaurant->email }}</a></p>
                                <p><strong>Site Web:</strong> <a href="{{ $restaurant->site_web }}" target="_blank">{{ $restaurant->site_web }}</a></p>
                                <p><strong>Type de Cuisine:</strong> {{ $restaurant->type_cuisine }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Certification Bio:</strong> 
                                    <span class="badge {{ $restaurant->certification_bio ? 'bg-success' : 'bg-danger' }}">
                                        {{ $restaurant->certification_bio ? 'Oui' : 'Non' }}
                                    </span>
                                </p>
                                <p><strong>Produits Locaux:</strong> 
                                    <span class="badge {{ $restaurant->produits_locaux ? 'bg-success' : 'bg-danger' }}">
                                        {{ $restaurant->produits_locaux ? 'Oui' : 'Non' }}
                                    </span>
                                </p>
                                <p><strong>Saisonnalité:</strong> 
                                    <span class="badge {{ $restaurant->saisonnalite ? 'bg-success' : 'bg-danger' }}">
                                        {{ $restaurant->saisonnalite ? 'Oui' : 'Non' }}
                                    </span>
                                </p>
                                <p><strong>Gestion des Déchets:</strong> 
                                    <span class="badge {{ $restaurant->gestion_dechets ? 'bg-success' : 'bg-danger' }}">
                                        {{ $restaurant->gestion_dechets ? 'Oui' : 'Non' }}
                                    </span>
                                </p>
                                <p><strong>Économie d'Eau:</strong> 
                                    <span class="badge {{ $restaurant->economie_eau ? 'bg-success' : 'bg-danger' }}">
                                        {{ $restaurant->economie_eau ? 'Oui' : 'Non' }}
                                    </span>
                                </p>
                                <p><strong>Description:</strong> {{ $restaurant->description }}</p>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            @if($restaurant->image_url)
                                <img src="{{ $restaurant->image_url }}" alt="Image de {{ $restaurant->nom }}" class="img-fluid rounded shadow-sm" style="max-height: 400px; object-fit: cover;">
                            @else
                                <p class="text-muted">Aucune image disponible pour ce restaurant.</p>
                            @endif
                        </div>
                    </div>
                </div>
<!-- New section for reviews -->
<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5>Avis du Restaurant</h5>
    </div>
    <div class="card-body">
        @if($restaurant->avis->isEmpty())
            <p class="text-muted">Aucun avis disponible pour ce restaurant.</p>
        @else
            @foreach($restaurant->avis as $avis)
                <div class="mb-3" id="avis-{{ $avis->id_avis }}">
                    <strong>{{ $avis->user->username ?? 'Utilisateur Anonyme' }}</strong>
                    <!-- Display mode -->
                    <div class="display-mode">
                        <div class="rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $avis->note)
                                    <!-- Display filled star for each point the user has rated -->
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <!-- Display empty star for remaining points -->
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                        </div>
                        <p>{{ $avis->commentaire }}</p>
                        <small class="text-muted">{{ $avis->created_at->format('d-m-Y H:i') }}</small>
                    </div>

                    <!-- Edit mode (Initially hidden) -->
                    <div class="edit-mode d-none">
                        <form action="{{ route('avis.restaurant.update', $avis->id_avis) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <textarea class="form-control" name="commentaire">{{ $avis->commentaire }}</textarea>
                            </div>
                            <div class="mb-3">
                                <select class="form-select" name="note" required>
                                    <option value="1" {{ $avis->note == 1 ? 'selected' : '' }}>1</option>
                                    <option value="2" {{ $avis->note == 2 ? 'selected' : '' }}>2</option>
                                    <option value="3" {{ $avis->note == 3 ? 'selected' : '' }}>3</option>
                                    <option value="4" {{ $avis->note == 4 ? 'selected' : '' }}>4</option>
                                    <option value="5" {{ $avis->note == 5 ? 'selected' : '' }}>5</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Enregistrer</button>
                            <button type="button" class="btn btn-secondary cancel-edit">Annuler</button>
                        </form>
                    </div>

                    <!-- Edit and Delete Icons -->
                    <div class="mt-2">
                        <a href="javascript:void(0)" class="text-primary me-2 edit-button" title="Modifier">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('avis.restaurant.client.delete', $avis->id_avis) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet avis ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger p-0" title="Supprimer">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <hr>
            @endforeach
        @endif
    </div>
</div>

<!-- JavaScript for toggling edit mode -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.edit-button').forEach(function (editButton) {
            editButton.addEventListener('click', function () {
                const parentDiv = this.closest('.mb-3');
                parentDiv.querySelector('.display-mode').classList.add('d-none');
                parentDiv.querySelector('.edit-mode').classList.remove('d-none');
            });
        });

        document.querySelectorAll('.cancel-edit').forEach(function (cancelButton) {
            cancelButton.addEventListener('click', function () {
                const parentDiv = this.closest('.mb-3');
                parentDiv.querySelector('.edit-mode').classList.add('d-none');
                parentDiv.querySelector('.display-mode').classList.remove('d-none');
            });
        });
    });
</script>


<div class="card shadow-sm mb-4">
    <div class="card-header">
        <h5>Laisser un Avis</h5>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('avis.restaurant.store', $restaurant->id_restaurant) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <select class="form-select" id="note" name="note" required>
                    <option value="">Sélectionnez une note</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="commentaire" class="form-label">Commentaire</label>
                <textarea class="form-control" id="commentaire" name="commentaire" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter Avis</button>
        </form>
    </div>
</div>



            </div>
        </div>
    </div>
@endsection
