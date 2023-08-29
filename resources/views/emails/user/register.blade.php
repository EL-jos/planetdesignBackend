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
        <p>Cher {{ $user->lastname .' '. $user->firtname }}</p>
        <p>
            Nous vous souhaitons la bienvenue sur notre site PLANETDESIGN
            Nous sommes ravis de vous accueillir parmi notre communauté.
        </p>
        <p>
            Nous avons bien enregistré la création de votre compte.
            Avant de pouvoir profiter pleinement de toutes les fonctionnalités de notre site,
            veuillez cliquer sur le lien ci-dessous pour activer votre adresse e-mail et valider votre compte :
        </p>

        <a href="{{ route('activeAccount.auth', $user) }}">{{ route('activeAccount.auth', $user) }}</a>
        <p>
            En activant votre compte, vous pourrez bénéficier d'une expérience personnalisée,
            rester informé des dernières actualités.
        </p>
        <p>
            Si vous avez des questions ou des préoccupations, n'hésitez pas à nous contacter.
            Notre équipe de support se tient à votre disposition pour vous aider.
        </p>
        <p>
            Encore une fois, bienvenue dans notre communauté !
            Nous espérons que vous apprécierez votre expérience sur notre site.
        </p>
        <p>
            Cordialement, <br />
            L'équipe de notre site PLANETDESIGN
        </p>
    </body>
</html>




