@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Transports List'])
    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <a href="{{ route('transport.add') }}" class="btn btn-primary">Ajouter un Transport</a>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Modele</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prix-Heure</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Batterie</th>

                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Lieux-Location</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>


                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transport as $transport)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center" style="margin-left: 20px">

                                                    <p class="text-sm text-secondary mb-0">{{ $transport->type }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $transport->model }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $transport->status }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $transport->prix_heure }}</p>
                                        </td>

                                        <td class="align-middle text-center">
                                            <p class="text-sm font-weight-bold mb-0">{{ $transport->battrie }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <p class="text-sm text-secondary mb-0">{{ $transport->lieux_location }}</p>
                                        </td>
                                        <td>



                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center" style="margin-left: 20px">


                                                    <img src="{{ $transport->image_url }}"  class="avatar" style="border-radius: 200px;">

                                                </div>
                                            </div>
                                        </td>



                                        <td class="align-middle text-end">
                                            <div class="d-flex px-3 py-1 justify-content-center align-items-center">
                                                <a href="{{ route('transport.edit', $transport->id_transport) }}" class="text-sm font-weight-bold mb-0" style="color: blue; margin-right: 10px;">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                 <form method="POST" action="{{ route('transport.delete', $transport->id_transport) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this transport?');">
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
                       {{--  @if($transports->isEmpty())
                            <p class="text-center">No Transport available.</p>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
