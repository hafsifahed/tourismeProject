@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Restaurants'])

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row">
                            @foreach ($restaurants as $restaurant)
                                <div class="col-md-4 mb-4"> <!-- Adjust column size as needed -->
                                    <div class="card shadow-sm">
                                        <img src="{{ $restaurant->image_url }}" class="card-img-top" alt="{{ $restaurant->nom }}">
                                        <div class="card-body">
                                            <a href="{{ route('restaurant.show.client', $restaurant->id_restaurant) }}" class="card-title">{{ $restaurant->nom }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div style="margin-left: 50px">
                            {{ $restaurants->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
