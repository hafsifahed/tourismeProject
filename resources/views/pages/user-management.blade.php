@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'User Management'])

<div class="container mt-4">
    <h1 class="mb-4">Gestion des Utilisateurs</h1>

    @if ($users->isEmpty())
        <div class="alert alert-warning">Aucun utilisateur trouvé.</div>
    @else
        <div class="card mb-4">
            <div class="card-header">
                <h6>Liste des Utilisateurs</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom d'utilisateur</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rôle</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de création</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td> <!-- Assuming roles relationship -->
                                    <td>{{ $user->created_at }}</td>
                                    <td>
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-info">Voir</a>

                                         <!-- Delete Button with Confirmation Alert -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete()">Supprimer</button>
                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

 <!-- If you're paginating users -->
            </div>
        </div>
    @endif
</div>

<script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete this user? This action cannot be undone.")) {
                // If confirmed, submit the form
                event.target.closest("form").submit();
            }
        }
    </script>
@endsection