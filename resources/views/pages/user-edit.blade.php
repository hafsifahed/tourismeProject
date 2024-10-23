@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Profile'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow-lg mx-4">
                    <div class="card-header pb-0">
                        <h6>Edit Profile</h6>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <p class="text-uppercase text-sm">User Information</p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input class="form-control" type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input class="form-control" type="text" id="firstname" name="firstname" value="{{ old('firstname', $user->firstname) }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}">
                                </div>
                            </div>

                            <hr class="horizontal dark">

                            <p class="text-uppercase text-sm">Contact Information</p>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input class="form-control" type="text" id="address" name="address" value="{{ old('address', $user->address) }}">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for "city"  class =form-label>City</label> 
                                    <input class =form-control
                                           type =text
                                           id =city
                                           name =city
                                           value="{{ old('city', $user->city) }}">
                                </div>
                                <div class "col-md-4 mb-3">
                                    <label for "country"  class =form-label>Country</label> 
                                    <input class =form-control
                                           type =text
                                           id =country
                                           name =country
                                           value="{{ old('country', $user->country) }}">
                                </div>
                                <div class "col-md-4 mb-3">
                                    <label for "postal"  class =form-label>Postal Code</label> 
                                    <input class =form-control
                                           type =text
                                           id =postal
                                           name =postal
                                           value="{{ old('postal', $user->postal) }}">
                                </div>
                            </div>

                            <hr class='horizontal dark'>
                            
                            <!-- Password Input -->
                            <p class='text-uppercase text-sm'>Change Password (Optional)</p>
                            <div class='row mb-3'>
                                <div class='col-md-6 mb-3'>
                                    <label for='password' class='form-label'>New Password</label>
                                    <input type='password' id='password' name='password' placeholder='Leave blank to keep current password' class='form-control'>
                                </div>
                                <div class='col-md-6 mb-3'>
                                    <label for='password_confirmation' class='form-label'>Confirm New Password</label>
                                    <input type='password' id='password_confirmation' name='password_confirmation' placeholder='Leave blank to keep current password' class='form-control'>
                                </div>
                            </div>

                            <!-- Role Selection -->
                            <p class='text-uppercase text-sm'>Role Information</p>
                            <div class='row mb-3'>
                                <div class='col-md-12'>
                                    <label for='role' class='form-label'>Role</label>
                                    <select id='role' name='role' class='form-select' required>
                                        <option value=''>Select Role</option>
                                        <option value='admin' {{ (old('role', $user->role) == 'admin') ? 'selected' : '' }}>Admin</option>
                                        <option value='user' {{ (old('role', $user->role) == 'user') ? 'selected' : '' }}>User</option>
                                    </select>
                                </div>
                            </div>

                            <!-- About Me -->
                            <hr class='horizontal dark'>
                            <p class='text-uppercase text-sm'>About Me</p> 
                            <div class='row mb-3'> 
                                <div class='col-md-12'> 
                                    <textarea class='form-control'
                                              name='about'>{{ old('about', $user->about) }}</textarea> 
                                </div> 
                            </div>

                            <!-- Submit button -->
                            <button type='submit'
                                     class='btn btn-primary'>Update Profile</button>

                            <!-- Back button -->
                            <a href="{{ route('users.index') }}"
                               class='btn btn-secondary mt-3'>Back to User List</a>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Profile Picture Section -->
            <!-- Optional: You can include a profile picture section here if needed -->
        </div>

        @include('layouts.footers.auth.footer')
    </div>

@endsection