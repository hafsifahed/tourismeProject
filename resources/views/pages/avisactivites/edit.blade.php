@extends('layouts.app')

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Modifier Avis'])

    <div class="row mt-4 mx-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">

                    <!-- Display validation errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('avis.update', $avis->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="note" class="form-label">Note (1 à 5)</label>
                            <input type="number" name="note" id="note"  value="{{ old('note', $avis->note) }}"  class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="commentaire" class="form-label">Commentaire (facultatif)</label>
                            <textarea name="commentaire" id="commentaire" rows="3" class="form-control">{{ old('commentaire', $avis->commentaire) }}</textarea>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class='btn btn-primary'>Mettre à jour l'Avis</button>

                        <!-- Back link -->
                        <a href="{{ route('avis.list') }}" class='btn btn-secondary mt-3'>Retour à la liste</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection