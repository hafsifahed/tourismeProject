<!-- resources/views/backoffice/reservations/index.blade.php -->

@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Gestion des Réservations'])

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Gestion des Réservations</h2>

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Total des Réservations</h5>
                        <p class="card-text display-4">{{ $totalReservations }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-success">
                    <div class="card-body">
                        <h5 class="card-title text-success">Revenus Totals</h5>
                        <p class="card-text display-4">€{{ number_format($totalRevenue, 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-warning">
                    <div class="card-body">
                        <h5 class="card-title text-warning">Réservations Confirmée</h5>
                        <p class="card-text display-4">{{ $reservations->where('status', 'confirmée')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Statistiques par Statut</h4>
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Réservations Mensuelles</h4>
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const statusData = {
                labels: {!! json_encode($reservationsByStatus->pluck('status')) !!},
                datasets: [{
                    label: 'Réservations par Statut',
                    data: {!! json_encode($reservationsByStatus->pluck('count')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            };

            const monthlyData = {
                labels: {!! json_encode($monthlyReservations->pluck('month')) !!},
                datasets: [{
                    label: 'Réservations Mensuelles',
                    data: {!! json_encode($monthlyReservations->pluck('count')) !!},
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            };

            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            const statusChart = new Chart(ctxStatus, {
                type: 'bar',
                data: statusData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
            const monthlyChart = new Chart(ctxMonthly, {
                type: 'line',
                data: monthlyData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

        <h4 class="mt-4">Liste des Réservations</h4>
        <table class="table table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Hébergement</th>
                    <th>Utilisateur</th>
                    <th>Date de Début</th>
                    <th>Date de Fin</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->hebergement->name }}</td>
                        <td>{{ $reservation->user->username }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->start_date)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($reservation->end_date)->format('d/m/Y') }}</td>
                        <td>{{ ucfirst($reservation->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
