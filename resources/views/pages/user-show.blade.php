@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Profile'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-lg mx-4 card-profile-bottom">
                    <div class="card-body p-3">
                        <div class="row gx-4">
                            <div class="col-auto">
                                
                            </div>
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">{{ $user->username }}</h5>
                                    <p class="mb-0 font-weight-bold text-sm">{{ $user->role }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header pb-0">
                        <p class="mb-0">User Information</p>
                    </div>
                    <div class="card-body">
                        <!-- User Details -->
                        <p class="text-uppercase text-sm">User Information</p>
                        <p><strong>Username:</strong> {{ $user->username }}</p>
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>First Name:</strong> {{ $user->firstname }}</p>
                        <p><strong>Last Name:</strong> {{ $user->lastname }}</p>

                        <!-- Contact Information -->
                        <hr class="horizontal dark">
                        <p class="text-uppercase text-sm">Contact Information</p>
                        <p><strong>Address:</strong> {{ $user->address }}</p>
                        <p><strong>City:</strong> {{ $user->city }}</p>
                        <p><strong>Country:</strong> {{ $user->country }}</p>
                        <p><strong>Postal Code:</strong> {{ $user->postal_code }}</p>

                        <!-- About Me -->
                        <hr class='horizontal dark'>
                        <p class='text-uppercase text-sm'>About Me</p>
                        <textarea class='form-control' readonly>{{ $user->about }}</textarea>

                        <!-- Delete Button with Confirmation Alert -->
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger mt-3" onclick="confirmDelete()">Supprimer</button>
                        </form>

                    </div>
                </div>
            </div>

            <!-- Profile Picture Section -->
            <!-- Optional: You can include a profile picture section here if needed -->
        </div>

        @include('layouts.footers.auth.footer')
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