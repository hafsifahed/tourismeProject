@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Postuler pour une Candidature'])

<div class="container mt-4">
    <h1 class="mb-4 text-center">Postuler pour une Candidature</h1>
    <br><br><br><br><br><br><br><br>
    <!-- Form for submitting a new candidacy -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="{{ route('candidatures.store') }}" method="POST" enctype="multipart/form-data"> <!-- Add enctype -->
                @csrf
                <div class="form-group">
                    <label for="nom">Nom du candidat</label>
                    <input type="text" id="nom" name="nom" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="motivation">Motivation</label>
                    <textarea id="motivation" name="motivation" class="form-control" rows="4" required></textarea>
                </div>

                <!-- New field for CV upload -->
                <div class="form-group">
                    <label for="cv">Télécharger le CV (format PDF)</label>
                    <input type="file" id="cv" name="cv" class="form-control-file" accept=".pdf" required>
                </div>

                <button type="submit" class="btn btn-success">Soumettre la Candidature</button>
            </form>
        </div>
    </div>
</div>
@endsection
