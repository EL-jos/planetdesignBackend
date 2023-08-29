<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice th, .invoice td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .invoice th {
            background-color: #f2f2f2;
        }
        .invoice tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        .invoice tr:nth-child(odd) {
            background-color: #ffffff;
        }
        .total {
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>
<table class="invoice">
    <tr>
        <th>Image</th>
        <th>Désignation</th>
        <th>Catégorie</th>
        <th>Disponibilité</th>
    </tr>
    <tr>
        <td><img src="{{ $article->compressImage() }}" alt="Article Image"></td>
        <td>
            <div>
                <span>{{ $article->reference }}</span>
                <h2>{{ $article->name }}</h2>
                <p>{!! htmlspecialchars_decode($article->description) !!}</p>
                Couleur:
                @foreach($article->colors as $color)
                    {{ $color->name }},
                @endforeach
                <br />
                Matière:
                @foreach($article->materials as $material)
                    {{ $material->name }},
                @endforeach
            </div>
        </td>
        <td>{{ $article->subcategory->name }}</td>
        <td>{{ $article->availability->name }}</td>
    </tr>
</table>
</body>
</html>
