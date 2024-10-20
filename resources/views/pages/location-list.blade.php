@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Location Transport List'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="{{ route('location-transport.create') }}" class="btn btn-primary">Ajouter une Location</a>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Transport Type</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Transport Model</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Debut</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date Fin</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prix Total</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locationTransports as $locationTransport)
                                    <tr>
                                        <td>{{ $locationTransport->transport ? $locationTransport->transport->type : 'N/A' }}</td>
                                        <td>{{ $locationTransport->transport ? $locationTransport->transport->model : 'N/A' }}</td>
                                        <td>{{ $locationTransport->user ? $locationTransport->user->name : 'N/A' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($locationTransport->date_debut)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($locationTransport->date_fin)->format('d/m/Y') }}</td>
                                        <td>{{ $locationTransport->status }}</td>
                                        <td>{{ $locationTransport->prix_total }}</td>
                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                
                                                <a href="{{ route('location.edit', ['id' => $locationTransport->id_location]) }}" class="text-sm font-weight-bold mb-0" style="color: blue; text-decoration: none;">
                                                    Edit
                                                </a>

                                                <form method="POST" action="{{ route('location.delete', $locationTransport->id_location) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this location?');">
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
                        @if($locationTransports->isEmpty())
                            <p class="text-center">No Transport Locations available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
