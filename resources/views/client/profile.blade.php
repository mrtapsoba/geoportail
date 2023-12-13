@guest
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>

    <body>
        <h2>Vous n'etes pas connecter</h2>
    </body>

    </html>
@else
    @extends('layouts.allFrameClient')


    @section('headLinks')
        <link rel="stylesheet" href="css/clientProfile.css">
    @endsection

    @section('moncompte')
        class="active"
    @endsection
    @section('moncomptePhone')
        class="active"
    @endsection

    @section('sectiontitle')
        Mon compte
    @endsection

    @section('content')
        <h2>Informations personelles 2</h2>
        <div class="infos-perso">
            <div class="info">
                <h3>Type de compte</h3>
                <p><b>{{ Auth::user()->account_type }} </b></p>
            </div>
            <div class="info">
                <h3>Téléphone</h3>
                <p><b><a href="tel:+22666823760">{{ Auth::user()->phone }} </a></b></p>
            </div>
            <div class="info">
                <h3>Nom de famille</h3>
                <p class="last-name"><b>{{ Auth::user()->nom }} </b></p>
            </div>
            <div class="info">
                <h3>Prenom(s)</h3>
                <p class="first-name"><b>{{ Auth::user()->prenom }} </b></p>
            </div>
            <div class="info">
                <h3>Profession</h3>
                <p><b>{{ Auth::user()->profession }} </b></p>
            </div>
            <div class="info">
                <h3>Adresse email</h3>
                <p><b>{{ Auth::user()->email }} </b></p>
            </div>
            <div class="info">
                <h3>Biographie</h3>
                <p class="biographie">{{ Auth::user()->biographie }} </p>
            </div>

        </div>


        <h2>Changer de mot de passe</h2>
        <form action="" method="post">
            @csrf

            <div class="inputs-field">
                <input type="password" name="passwordold" placeholder="Ancien mot de passe">
                <input type="password" name="passwordnew1" placeholder="Nouveau mot de passe">
                <input type="password" name="passwordnew2" placeholder="Confirmer le nouveau">
            </div>
            <div class="inputs-details">
                <p>Le mot de passe doit etre au moins de <b>08 caractères</b> et contenant au moins <b>une lettre majuscule</b>,
                    <b>une lettre minuscule</b> et <b>un chiffre</b>.
                </p>
                <input type="submit" value="Changer maintenant">
            </div>
        </form>
    @endsection

@endguest
