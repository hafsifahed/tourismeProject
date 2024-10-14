<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Candidature</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .details {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        .btn {
            padding: 10px 15px;
            background-color: #5cb85c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Détails de la Candidature</h1>

    <div class="details">
        <p><strong>Nom du candidat:</strong> {{ $candidature->nom_candidat }}</p>
        <p><strong>Email:</strong> {{ $candidature->email }}</p>
        <p><strong>Téléphone:</strong> {{ $candidature->telephone }}</p>
        <p><strong>Poste:</strong> {{ $candidature->poste }}</p>
        <p><strong>Date de candidature:</strong> {{ $candidature->created_at->format('d/m/Y') }}</p>
    </div>

    <a href="{{ route('candidatures.index') }}" class="btn">Retour à la liste</a>
</body>
</html>
