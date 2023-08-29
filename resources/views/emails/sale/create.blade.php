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
            Nous vous remercions d'avoir soumis votre demande de ticket sur notre plateforme d'achat de billets en ligne pour les événements.
            Nous tenons à vous informer que votre demande, associée à votre nom (<strong>{{ $sale->user->lastname }} {{ $sale->user->name }}</strong>), a été reçue avec succès.
        </p>
        <p>
            Notre équipe est actuellement en train de traiter votre demande avec la plus grande attention.
            Nous nous engageons à vous fournir une réponse dans les plus brefs délais.
            Un de nos agents vous contactera prochainement, pour vous assister dans votre réservation et répondre à toutes vos questions.
        </p>
        <p>
            Nous vous remercions de votre patience et de votre confiance en nos services.
            Si vous avez des préoccupations supplémentaires, n'hésitez pas à nous contacter en utilisant les coordonnées fournies sur notre site web.
        </p>
        <p>
            Cordialement, <br />
            L'équipe de support Last Level Event.
        </p>
    </body>
</html>




