@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Détails du Transport</h3>
        </div>
        <div class="card-body">
            <!-- Message de succès -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Image et détails du transport -->
            @if($transport->image_url)
                <div class="mb-3 text-center">
                    <img src="{{ asset('storage/' . $transport->image_url) }}" class="img-fluid rounded" alt="{{ $transport->model }}">
                </div>
            @else
                <div class="mb-3 text-center">
                    <img src="{{ asset('default_image.jpg') }}" class="img-fluid rounded" alt="Default Image">
                </div>
            @endif

            <div class="mb-3"><strong>Type :</strong> {{ $transport->type }}</div>
            <div class="mb-3"><strong>Modèle :</strong> {{ $transport->model }}</div>
            <div class="mb-3"><strong>Prix par heure :</strong> {{ $transport->prix_heure }} TND</div>
            <div class="mb-3"><strong>Batterie :</strong> {{ $transport->battrie }}%</div>
            <div class="mb-3"><strong>Lieu de location :</strong> {{ $transport->lieux_location }}</div>

            <!-- Bouton Louer ce transport -->
            <div class="text-center mt-4">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#locationModal">Louer ce transport</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour le formulaire de location -->
<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel">Louer ce transport</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('location.louer') }}" method="POST">
                @csrf
                <!-- Transport ID (Hidden) -->
                <input type="hidden" name="id_transport" value="{{ $transport->id_transport }}">
            
                <!-- User ID (Currently logged-in user) -->
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            
                <!-- Date début -->
                <div class="mb-3">
                    <label for="date_debut" class="form-label">Date de début</label>
                    <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                </div>
            
                <!-- Date fin -->
                <div class="mb-3">
                    <label for="date_fin" class="form-label">Date de fin</label>
                    <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                </div>
            
                <!-- Status (Hidden, always 'Active' for a new rental) -->
                <input type="hidden" name="status" value="Active">
            
                <!-- Prix total (Calculated based on selected dates) -->
                <div class="mb-3">
                    <label for="prix_total" class="form-label">Prix total</label>
                    <input type="number" class="form-control" id="prix_total" name="prix_total" readonly>
                </div>
            
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary">Confirmer la location</button>
            
                <!-- Cancel button (Redirect to another page, e.g., transport list) -->
                <a href="{{ route('transport.list') }}" class="btn btn-secondary">Annuler</a>
            </form>
            
            
          

        </div> 
    </div>
</div>

<!-- JavaScript pour calculer le prix total -->
<script>
    document.getElementById('date_fin').addEventListener('change', function() {
        var dateDebut = new Date(document.getElementById('date_debut').value);
        var dateFin = new Date(this.value);
        var prixParHeure = {{ $transport->prix_heure }};
        
        // Calculer la différence en heures
        var differenceHeures = Math.abs(dateFin - dateDebut) / 36e5;
        var prixTotal = (differenceHeures * prixParHeure).toFixed(2);

        document.getElementById('prix_total').value = prixTotal;
    });
</script>
@endsection
