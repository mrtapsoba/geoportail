<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset( 'lib/bootstrap/css/bootstrap.min.css' )">
    <link rel="stylesheet" href="asset( 'lib/css/userdash.css' )">
    <!-- Font-->
    <link rel="stylesheet" type="text/css" href="asset( 'lib/css/opensans-font.css' )">
    <link rel="stylesheet" type="text/css" href="asset( 'lib/fonts/line-awesome/css/line-awesome.min.css' )">
    <!-- Jquery -->
    <link rel="stylesheet" href="asset( 'lib/css/jqueryvalidation.css' )">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="asset( 'lib/css/login.css' )" />
    <title>Geoportail du BURKINA FASO</title>
</head>

<body>
    <nav class="entete navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Geoportail du Burkina</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Constituer une carte</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Authentification</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="contentZone flex-content">
        <div class="form-v4-content">
            <div class="form-left">
                <h2>Soyez le bienvenu</h2>
                <p class="text-2">L'Institut Geographique du Burkina vous permet de créer
                    un compte sur leur plateforme afin de telecharger certaines
                    cartes constituer et aussi d'effectuer des demandes de cartes
                    et enfin d'apporter votre contribution pour l'ameliortion de
                    ses différents services.</p>
                <div class="form-left-last">
                    <button data-bs-toggle="modal" data-bs-target="#add" type="submit" name="account"
                        class=" account">je n'ai pas encore un compte</button>
                </div>

            </div>
            <form class="form-detail" action="user.php" method="post" id="myform">
                @csrf
                <h2>Formulaire de connexion</h2>
                <div class="form-row">
                    <input type="text" name="email" id="your_email" placeholder="Adresse email" class="input-text"
                        required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-row">
                    <input type="password" name="password" id="password" placeholder="mot de passe"
                        class="input-text" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-row-last">
                    <input type="submit" name="register" class="register" value="se connecter">
                </div>
            </form>
        </div>

        <div class="modal" id="add" tabindex="-1" role="dialog" aria-hidden="true" aria-labelledby="addLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title">
                            Inscription
                        </div>
                    </div>
                    <div class="modal-body">
                        <div>
                            <form action="user.php" method="post">
                                @csrf
                                <div class="col">
                                    <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom">
                                </div>
                                <div class="col">
                                    <input type="text" name="prenom" class="form-control" placeholder="Prenoms"
                                        id="prenom">
                                </div>
                                <div class="col">
                                    <input type="text" name="profile" class="form-control" id="profile"
                                        placeholder="Profile a l'IGB">
                                </div>
                                <div class="col">
                                    <input type="text" name="telephone" class="form-control" id="telephone"
                                        placeholder="Nurero de telephone">
                                </div>
                                <div class="col">
                                    <input type="mail" name="email" class="form-control" id="email"
                                        placeholder="Adresse e-mail">
                                </div>
                                <div class="col">
                                    <input type="mail" name="motdepasse" class="form-control" id="password"
                                        placeholder="Mot de passe">
                                </div>
                                <div class="col">
                                    <input type="text" name="profession" class="form-control" id="profession"
                                        placeholder="Votre profession">
                                </div>
                                <div class="col">
                                    <textarea placeholder="Votre biographie" name="biographie" class="form-control" id="biographie" id="" cols="30"
                                        rows="5"></textarea>
                                </div>
                                <div class="col ">
                                    <input class="simple-btn-invert" type="submit" value="Envoyer">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-tools suppr-btn" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <footer class="bt-profile-theme">
        Geoportail du Burkina Faso - IGB - TAPS - FLEX
    </footer> -->
    <script src="asset( 'lib/js/jquery/jquery.js' )"></script>
    <script src="asset( 'lib/bootstrap/js/bootstrap.bundle.min.js' )"></script>
</body>

</html>
