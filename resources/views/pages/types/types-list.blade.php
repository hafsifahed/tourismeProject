@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Liste des Types de Tours'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="{{ route('typetour.add') }}" class="btn btn-primary">Ajouter Type de Tour</a>
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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom du Type Tour</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($types as $type)
                                <tr>
                                    <td class="text-sm font-weight-bold mb-0">{{ $type->nom_tour }}</td>
                                    <td class="align-middle text-end">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <a href="{{ route('typetour.edit', $type->id) }}" class="text-sm font-weight-bold" style="color: blue; margin-right: 10px;">
                                                <i class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </a>
                                            <form method="POST" action="{{ route('typetour.delete', $type->id) }}" style="display:inline;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
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