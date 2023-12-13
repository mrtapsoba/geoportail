@extends('layouts.allFrameClient')


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

        <div class="infos-perso client">
            <div class="info">
                <h3>Objet</h3>
                <p><b>{{ $details->objet }}</b></p>
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

    </div>
@endsection


@section('scripts')
    <script src="{{ asset('/js/popper.js') }}"></script>
    <script src="{{ asset('/js/theme.js') }}"></script>
@endsection
