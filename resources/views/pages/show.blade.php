@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h3>Détails du Transport</h3>
        </div>
        <div class="card-body">
            @if($transport->image_url)
                <div class="mb-3 text-center">
                    <img src="{{ asset('storage/' . $transport->image_url) }}" class="img-fluid rounded" alt="{{ $transport->model }}">
                </div>
            @else
                <div class="mb-3 text-center">
                    <img src="{{ asset('default_image.jpg') }}" class="img-fluid rounded" alt="Default Image">
                </div>
            @endif

            <div class="mb-3"><strong>Type :</strong> {{ $transport->type }}</div>
            <div class="mb-3"><strong>Modèle :</strong> {{ $transport->model }}</div>
            <div class="mb-3"><strong>Prix par heure :</strong> {{ $transport->prix_heure }} TND</div>
            <div class="mb-3"><strong>Batterie :</strong> {{ $transport->battrie }}%</div>
            <div class="mb-3"><strong>Lieu de location :</strong> {{ $transport->lieux_location }}</div>

        </div>
    </div>
</div>
@endsection
