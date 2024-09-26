@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Restaurants List'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="{{ route('restaurant.add') }}" class="btn btn-primary">Ajouter Restaurant</a>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Ville</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type de Cuisine</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Plus d'infos</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($restaurants as $restaurant)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <img src="{{ $restaurant->image_url }}" alt="{{ $restaurant->nom }}" class="avatar" style="border-radius: 200px;">
                                                <div class="d-flex flex-column justify-content-center" style="margin-left: 20px">
                                                    <h6 class="mb-0 text-sm">
                                                        <a href="{{ route('restaurant.show', $restaurant->id_restaurant) }}" class="text-decoration-none text-primary">
                                                            {{ $restaurant->nom }}
                                                        </a>
                                                    </h6>
                                                    <p class="text-sm text-secondary mb-0">{{ $restaurant->adresse }}</p>
                                                </div>
                                            </div>
                                        </td>                                        
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $restaurant->ville }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $restaurant->type_cuisine }}</p>
                                        </td>
                                        
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center" style="margin-left: 20px">
                                                    <p class="mb-0 text-sm">{{ $restaurant->email }}</p>
                                                    <p class="text-sm text-secondary mb-0">{{ $restaurant->telephone }}</p>
                                                    <p class="text-sm text-secondary mb-0">
                                                        <a href="{{ $restaurant->site_web }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">Voir site web</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <a href="{{ route('restaurant.edit', $restaurant->id_restaurant) }}" class="text-sm font-weight-bold mb-0" style="color: blue; margin-right: 10px;">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form method="POST" action="{{ route('restaurant.delete', $restaurant->id_restaurant) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this restaurant?');">
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
                        @if($restaurants->isEmpty())
                            <p class="text-center">No restaurants available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
