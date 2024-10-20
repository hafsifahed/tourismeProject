@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>{{ $accommodation->name }}</h3>
            </div>
            <div class="card-body">
                <!-- Affichage des détails de l'hébergement -->
                @if($accommodation->image)
                    <div class="mb-3 text-center">
                        <img src="{{ asset('images/' . $accommodation->image) }}" class="img-fluid rounded" alt="{{ $accommodation->name }}">
                    </div>
                @endif

                <div class="mb-3"><strong>Type :</strong> {{ $accommodation->type }}</div>
                <div class="mb-3"><strong>Région :</strong> {{ $accommodation->region }}</div>
                <div class="mb-3"><strong>Adresse :</strong> {{ $accommodation->address }}</div>
                <div class="mb-3"><strong>Description :</strong><p>{{ $accommodation->description }}</p></div>
                <div class="mb-3"><strong>Prix par nuit :</strong> €<span id="pricePerNight">{{ $accommodation->price_per_night }}</span></div>

                <!-- Formulaire de réservation -->
                <h4 class="mt-4">Réserver cet hébergement</h4>
                <form action="{{ route('reservations.store') }}" method="POST" id="reservationForm" class="border p-4 rounded">
                    @csrf
                    <input type="hidden" name="hebergement_id" value="{{ $accommodation->id }}">

                    <div class="mb-3">
                        <label for="start_date" class="form-label">Date d'arrivée</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="end_date" class="form-label">Date de départ</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="guests" class="form-label">Nombre d'invités</label>
                        <input type="number" class="form-control" id="guests" name="guests" min="1" required>
                    </div>

                    <div class="mb-3">
                        <label for="special_requests" class="form-label">Demandes spéciales</label>
                        <textarea class="form-control" id="special_requests" name="special_requests" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="total_price" class="form-label">Prix Total Estimé</label>
                        <input type="text" class="form-control" id="total_price" name="total_price" readonly>
                    </div>

                    <button type="submit" class="btn btn-success">Réserver</button>
                </form>

                <!-- Messages de succès ou d'erreur -->
                @if(session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                @endif

                <!-- Bouton retour -->
                <a href="{{ route('hebergement.UI_index') }}" class="btn btn-secondary mt-3">Retour à la liste des hébergements</a>
            </div>
        </div>
    </div>

    <!-- JavaScript pour la logique de réservation -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const startDateInput = document.getElementById('start_date');
            const endDateInput = document.getElementById('end_date');
            const guestsInput = document.getElementById('guests');
            const totalPriceInput = document.getElementById('total_price');
            const pricePerNight = parseFloat(document.getElementById('pricePerNight').textContent);

            // Calculer le prix total
            function calculateTotalPrice() {
                const startDate = new Date(startDateInput.value);
                const endDate = new Date(endDateInput.value);
                const guests = parseInt(guestsInput.value) || 0;

                if (startDate && endDate && startDate < endDate) {
                    const timeDifference = endDate - startDate;
                    const days = timeDifference / (1000 * 60 * 60 * 24);
                    const totalPrice = days * pricePerNight * guests;
                    totalPriceInput.value = totalPrice.toFixed(2) + ' €';
                } else {
                    totalPriceInput.value = '0.00 €';
                }
            }

            // Écouteurs d'événements pour mettre à jour le prix total
            startDateInput.addEventListener('change', calculateTotalPrice);
            endDateInput.addEventListener('change', calculateTotalPrice);
            guestsInput.addEventListener('input', calculateTotalPrice);

            // Validation avant l'envoi du formulaire
            document.getElementById('reservationForm').addEventListener('submit', function (e) {
                if (totalPriceInput.value === '0.00 €') {
                    e.preventDefault();
                    alert('Veuillez vérifier les dates et le nombre d\'invités.');
                }
            });
        });
    </script>
@endsection
