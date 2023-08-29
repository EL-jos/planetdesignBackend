<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau devis de {{ $order->user->lastname }} {{ $order->user->firstname }}</title>
</head>
<body>
    <p>Nom : {{ $order->user->lastname }} {{ $order->user->firstname }}</p>
    <p>E-mail : {{ $order->user->email }}</p>
    <p>Message : {{ $order->content }}</p>
    <h2>Commande : {{ $order->id }}</h2>
    <ol>
        @foreach ($order->quotes as $quote)
            <li>
                <p>Article : {{ $quote->article->name }}, Quantité : {{ $quote->quantity }}</p>
                <ul>
                    @foreach($quote->colors as $color)
                        <li>{{ $color->name }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ol>
</body>
</html>
