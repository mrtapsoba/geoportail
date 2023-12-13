<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/userdash.css') }}">
    <!-- Font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/opensans-font.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/fonts/line-awesome/css/line-awesome.min.css') }}">
    <!-- Jquery -->
    <link rel="stylesheet" href="{{ asset('/bootstrapcss/jqueryvalidation.css') }}">
    <!-- Main Style Css -->
    <link rel="stylesheet" href="{{ asset('/css/login.css') }}" />
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
                    <button data-toggle="modal" data-target="#add" class=" account">je n'ai pas encore un
                        compte</button>
                </div>

            </div>
            <form class="form-detail" action="{{ route('login.custom') }}" method="post" id="myform">
                @csrf
                <h2>Formulaire de connexion</h2>
                <div class="form-group mb-3">
                    <input type="email" placeholder="Email" class="form-control" name="email" autofocus
                        class="input-text" required pattern="[^@]+@[^@]+.[a-zA-Z]{2,6}">
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif

                </div>
                <div class="form-group mb-3">
                    <input type="password" placeholder="Password" id="password" class="form-control input-text"
                        name="password" required>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
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
                            <form action="{{ route('register.custom') }}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" name="nom" class="form-control" id="nom" placeholder="Nom"
                                        required autofocus>
                                    @if ($errors->has('nom'))
                                        <span class="text-danger">{{ $errors->first('nom') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" name="prenom" class="form-control" placeholder="Prenoms"
                                        id="prenom" required autofocus>
                                    @if ($errors->has('prenom'))
                                        <span class="text-danger">{{ $errors->first('prenom') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="text" name="profession" class="form-control" id="profile"
                                        placeholder="Profession" required autofocus>
                                    @if ($errors->has('profession'))
                                        <span class="text-danger">{{ $errors->first('profession') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="tel" name="phone" class="form-control" id="telephone"
                                        placeholder="Nurero de telephone" required autofocus>
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Adresse e-mail" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input type="password" name="passwordR" class="form-control"
                                        placeholder="Mot de passe">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{ $errors->first('passwordR') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <textarea placeholder="Votre biographie" name="biographie" class="form-control" id="biographie" id="" cols="30"
                                        rows="5"></textarea>
                                    @if ($errors->has('biographie'))
                                        <span class="text-danger">{{ $errors->first('biographie') }}</span>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <input class="simple-btn-invert" type="submit" value="s'inscrire">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-tools suppr-btn" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <footer class="bt-profile-theme">
        Geoportail du Burkina Faso - IGB - TAPS - FLEX
    </footer> -->
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/bootstrap/js/bootstrap.min.js') }}"></script>
</body>

</html>
