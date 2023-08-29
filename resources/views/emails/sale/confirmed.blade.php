<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'Michroma', sans-serif !important;
            margin: 0;
            padding: 0;
            letter-spacing: 1px;
            line-height: 1.5rem;
        }body{
             display: flex;
             flex-direction: column;
             gap: 1rem;
             padding: 2rem;
         }h1{
              color: #1a1a1a;
              font-weight: 600;
              font-size: 24px;
          }p{
               color: #68686d;
               font-weight: 300;
               font-size: 16px;
           }strong{
                color: #1a1a1a;
                font-weight: 600;
            }
    </style>
</head>
<body>
    <p>Cher {{ $sale->user->username }}</p>
    <p>
        Nous sommes ravis de vous informer que votre réservation de ticket pour l'événement <strong>{{ $sale->event->title }}</strong> a été confirmée avec succès !
    </p>
    <p>Ci-dessous, vous trouverez les détails de votre réservation :</p>
    <ul>
        <li>Événement : {{ $sale->event->title }}</li>
        <li>Adresse : {{ $sale->event->location }}</li>
        <li>Date et heure : Le {{ date('d/m/Y', strtotime($sale->event->date)) }} à {{ date('H:i', strtotime($sale->event->time)) }}</li>
        <li>Quantité de tickets : {{ $sale->quantity }}</li>
        <li>Type : {{ $sale->type->name }}</li>
        <li>Montent payé : {{ $sale->price }} $</li>
    </ul>
    <p>
        Votre ticket électronique est désormais disponible en téléchargement.
        Cliquez sur le lien ci-dessous pour télécharger votre ticket :
    </p>
    <a href="{{ route('sale.show', $sale) }}">{{ route('sale.show', $sale) }}</a>
    <p>
        Assurez-vous d'imprimer votre ticket ou de le conserver sur votre appareil mobile pour le présenter à l'entrée de l'événement.
        Veuillez noter que votre ticket est personnel et non transférable.
    </p>
    <p>
        Nous vous remercions de votre réservation et nous espérons que vous passerez un moment extraordinaire à l'événement.
        En cas de questions ou de besoin d'assistance supplémentaire, n'hésitez pas à nous contacter.
    </p>
    <p>
        Cordialement, <br />
        L'équipe de Last Level Event
    </p>
</body>
</html>




