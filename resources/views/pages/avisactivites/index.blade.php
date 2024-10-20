@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Liste des Avis'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h5>Liste des Avis</h5>
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
                    

                    <div class="table-responsive p-0 mt-4">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Activité</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Utilisateur</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Note</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Commentaire</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($avis as $item)
                                    <tr>
                                        <td>{{ $item->activite->nom }}</td>
                                        <td>{{ optional($item->utilisateur)->email }}</td> <!-- Assuming you have a name field in User -->
                                        <td>{{ $item->note }}</td>
                                        <td>{{ $item->commentaire }}</td>

                                        <td class="align-middle text-end">
                                            <a href="{{ route('avis.show', $item->id) }}" class="btn btn-info">Voir</a>
                                            <a href="{{ route('avis.edit', $item->id) }}" class="btn btn-warning">Modifier</a>

                                            <!-- Assuming there is a route to delete the review -->
                                            <form action="{{ route('avis.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                    <!-- Chart for Average Ratings -->
                    @if(auth()->check() && auth()->user()->role === 'admin')
                        <h6>Statistiques des Avis par Activité</h6>
                        <canvas id="activityChart"></canvas>
                    @endif
                </div> 
            </div> 
        </div> 
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('activityChart').getContext('2d');
        const activityChart = new Chart(ctx, {
            type: 'bar', // You can change this to 'line', 'pie', etc.
            data: {
                labels: {!! json_encode(array_keys($averageRatings)) !!}, // Activity names
                datasets: [{
                    label: 'Note Moyenne',
                    data: {!! json_encode(array_values($averageRatings)) !!}, // Average ratings
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Note'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Activités'
                        }
                    }
                }
            }
        });
    </script>

@endsection