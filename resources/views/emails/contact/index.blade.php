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
        <title>Nouveau message de contact</title>
    </head>
    <body>
        <h1>Nouveau message de contact</h1>

        <p><strong>Prénom et Nom :</strong> {{ $lastname }} {{ $name }}</p>
        <p><strong>E-mail :</strong> {{ $email }}</p>
        <p><strong>Téléphone :</strong> {{ $phone }}</p>
        <p><strong>Sujet :</strong> {{ $subject }}</p>
        <p><strong>Message :</strong></p>
        <p>{{ $content }}</p>
    </body>
</html>




