@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Détails de l\'Activité'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">

                    <h2>{{ $activite->nom }}</h2>
                    <p><strong>Description:</strong> {{ $activite->description }}</p> 
                    <p><strong>Date:</strong> {{ $activite->date }}</p> 
                    <p><strong>Lieu:</strong> {{ $activite->lieu }}</p>

                    <!-- Action buttons only for admin users -->
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="mt-4">
                            <a href="{{ route('activites.edit', $activite->id) }}" class='btn btn-warning'>Modifier</a>

                            <!-- Form for deletion -->
                            <form action="{{ route('activites.destroy', $activite->id) }}" method='POST' style='display:inline;'>
                                @csrf 
                                @method('DELETE') 
                                <button type='submit' class='btn btn-danger'>Supprimer</button> 
                            </form>
                        </div>
                    @endif

                    <!-- Back link based on user role -->
                    @if(auth()->check())
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('activites.list') }}" class='btn btn-secondary mt-3'>Retour à la liste des Activités</a>
                        @else
                            <a href="{{ route('activites.activities') }}" class='btn btn-secondary mt-3'>Retour à la liste des Activités</a>
                        @endif
                    @else
                        <a href="{{ route('activites.list') }}" class='btn btn-secondary mt-3'>Retour à la liste des Activités</a>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <h3>Avis pour cette Activité</h3>
                    @if($activite->avis->isEmpty())
                        <p>Aucun avis disponible pour cette activité.</p>
                    @else
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Utilisateur</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Note</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Commentaire</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activite->avis as $avis)
                                    <tr>
                                        <td>{{ optional($avis->utilisateur)->email }}</td> <!-- Display user email -->
                                        <td>{{ $avis->note }}</td>
                                        <td>{{ $avis->commentaire }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div> 
            </div> 
        </div> 
    </div>

    <!-- Review Form only for user role -->
    @if(Auth::check() && auth()->user()->role === 'user')
        <div class="row mt-4 mx-4">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <h3>Laisser un avis</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('avis.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="activite_id" value="{{ $activite->id }}">
                            <input type="hidden" name="utilisateur_id" value="{{ Auth::id() }}">

                            <div class="form-group">
                                <label for="note">Note (1 à 5)</label>
                                <input type="number" name="note" id="note" min="1" max="5" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="commentaire">Commentaire (facultatif)</label>
                                <textarea name="commentaire" id="commentaire" rows="3" class="form-control"></textarea>
                            </div>

                            <button type="submit" class='btn btn-primary'>Soumettre</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        @if(Auth::check())
            <!-- Message for users who are logged in but not admins -->
            <p>Vous n'avez pas l'autorisation d'ajouter un avis.</p>
        @else
            <!-- Message for not logged in users -->
            <p class="text-danger">Vous devez être connecté pour laisser un avis.</p>
        @endif
    @endif

@endsection