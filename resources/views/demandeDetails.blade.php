@extends('layouts.allFrame')


@section('headLinks')
    <link rel="stylesheet" href="/css/demande.css">

    <link rel="stylesheet" href="/css/ionicons.min.css">
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('demande')
    class="active"
@endsection
@section('demandePhone')
    class="active"
@endsection

@section('sectiontitle')
    Demande
@endsection

@section('content')
    @include('partials.action_bar-demande')
    @if (session()->get('status'))
        @if (session()->get('status') == 0)
            <div class="alert alert-success mt-3">
                {{ session()->get('message') }}
            </div>
        @else
            <div class="alert alert-danger mt-3">
                {{ session()->get('message') }}
            </div>
        @endif
    @endif
    <div class="info-resp">

        <div class="infos-perso">
            <div class="info">
                <h3>Objet</h3>
                <p><b>{{ $details->objet }}</b></p>
            </div>
            <div class="info">
                <h3>Auteur</h3>
                <p><b>{{ $details->auteur }}</b></p>
            </div>
            <div class="info">
                <h3>etat</h3>
                <p><b>{{ $details->etat }}</b></p>
            </div>
            <div class="info">
                <h3>Adresse e-mail</h3>
                <p><b>{{ $details->email }}</b></p>
            </div>
            <div class="info">
                <h3>Date de modification</h3>
                <p><b>{{ $details->updated_at->format('d M Y à H:i') }}</b></p>
            </div>
            <div class="info">
                <h3>Date d'ajout</h3>
                <p><b>{{ $details->created_at->format('d M Y à H:i') }}</b></p>
            </div>
            <div class="info telech">
                <h3>Demande</h3>
                <p><b><a href="/demandes/{{ $details->fiche_demande }}">Telecharger</a></b></p>
            </div>
            <div class="info telech">
                <h3>Justificatifs</h3>
                <p><b><a href="/demandes/{{ $details->justificatifs }}">Telecharger</a></b></p>
            </div>
            <div class="info mot_cle">
                <h3>Mot cle</h3>
                <p><b>{{ $details->mot_cle }}</b></p>
            </div>
            <div class="info reponse">
                <h3>Reponse</h3>
                <p><b>
                        @if (count($details->reponses) > 0)
                            {{ $details->reponses[count($details->reponses) - 1]->response }}
                        @else
                            Aucune reponse pour l'instant
                        @endif
                    </b></p>
            </div>
        </div>

        <form class="resp" action="{{ route('demandereponsepost') }}" method="post">
            <h3>Repondre a la contribution</h3>
            @csrf
            <input type="hidden" name="id" value="{{ $details->id }}">
            <select name="etat" id="etat">
                <option selected disabled>Nouvel etat</option>
                <option class="col-8" value="1">En attente</option>
                <option class="col-8" value="2">En etude</option>
                <option class="col-8" value="3">Prise en compte</option>
                <option class="col-8" value="4">Rejetee</option>
            </select>
            @if ($errors->has('etat'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('etat') }}</strong>
                </span>
            @endif

            <textarea name="reponse" id="" cols="30" rows="6">Message a ajoute</textarea>

            @if ($errors->has('reponse'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('reponse') }}</strong>
                </span>
            @endif
            <div class="form-group mt-3 mb-2">
                <button type="submit" class="form-control submit-btn btn rounded submit px-3">Envoyer la reponse</button>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('/js/popper.js') }}"></script>
    <script src="{{ asset('/js/theme.js') }}"></script>
@endsection
