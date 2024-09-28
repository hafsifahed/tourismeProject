@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Avis Restaurants List'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">

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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Restaurant</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">note</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">commentaire</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($avis_restaurants as $avis)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center" style="margin-left: 20px">
                                                    <p class="mb-0 text-sm">{{ $avis->user->username }}</p>
                                                    {{-- <p class="text-sm text-secondary mb-0">
                                                        <a target="_blank" rel="noopener noreferrer" class="text-decoration-none">Voir user</a>
                                                    </p> --}}
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center" style="margin-left: 20px">
                                                    <p class="mb-0 text-sm">{{ $avis->restaurant->nom  }}</p>
                                                    <p class="text-sm text-secondary mb-0">
                                                        <a  href="{{ route('restaurant.show', ['id' => $avis->restaurant->id_restaurant]) }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none">Voir Restaurant</a>
                                                    </p>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $avis->note)
                                                        <span class="text-warning">&#9733;</span> <!-- Yellow star -->
                                                    @else
                                                        <span class="text-secondary">&#9734;</span> <!-- Gray star -->
                                                    @endif
                                                @endfor
                                            </p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $avis->commentaire }}</p>
                                        </td>

                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <form method="POST" action="{{ route('avis.restaurant.delete', $avis->id_avis) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this avis restaurant?');">
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
                        <br/>
                        <div style="margin-left: 50px">
                            {{ $avis_restaurants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
