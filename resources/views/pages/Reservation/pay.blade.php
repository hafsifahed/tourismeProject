<!-- resources/views/payment.blade.php -->
@extends('layouts.app')
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Hébergements Écoresponsables'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>

    <script src="https://js.stripe.com/v3/"></script>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h4>Paiement pour la réservation #{{ $reservation->id }}</h4>
                    </div>
                    <div class="card-body">
                        <form id="payment-form">
                            <div class="form-group">
                                <label for="card-element">Détails de la carte</label>
                                <div id="card-element" class="form-control"></div>
                                <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-4">Payer {{ number_format($reservation->total_price, 2) }} EUR</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var stripe = Stripe('{{ env('STRIPE_KEY') }}');
        var elements = stripe.elements();

        var card = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                    '::placeholder': {
                        color: '#aab7c4',
                    },
                },
            },
        });
        card.mount('#card-element');

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            fetch("{{ route('reservations.createPaymentIntent', $reservation->id) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            }).then(function(response) {
                return response.json();
            }).then(function(intentData) {
                return stripe.confirmCardPayment(intentData.client_secret, {
                    payment_method: {
                        card: card
                    }
                });
            }).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    alert("Paiement effectué avec succès !");
                    window.location.href = "/"; // Redirection après paiement réussi
                }
            });
        });
    </script>
</body>
</html>
@endsection