@extends('layouts.allFrameClient')


@section('headLinks')
    <link rel="stylesheet" href="/css/contribution.css">

    <link rel="stylesheet" href="/css/ionicons.min.css">
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('contribution')
    class="active"
@endsection
@section('contributionPhone')
    class="active"
@endsection

@section('sectiontitle')
    Contribution
@endsection

@section('content')
    @include('partials.action_bar-contribution')
    <div class="infos-perso">
        <div class="info">
            <h3>Objet</h3>
            <p><b>{{ $details['objet'] }}</b></p>
        </div>
        <div class="info">
            <h3>Auteur</h3>
            <p><b>{{ $details['auteur'] }}</b></p>
        </div>
        <div class="info">
            <h3>etat</h3>
            <p><b>{{ $details['etat'] }}</b></p>
        </div>
        <div class="info">
            <h3>Date de modification</h3>
            <p><b>{{ $details['modifDate'] }}</b></p>
        </div>
        <div class="info">
            <h3>Date d'ajout</h3>
            <p><b>{{ $details['addDate'] }}</b></p>
        </div>
        <div class="info description">
            <h3>Description</h3>
            <p><b>{{ $details['description'] }}</b></p>
        </div>
        <div class="info reponse">
            <h3>Reponse</h3>
            <p><b>{{ $details['reponse'] }}</b></p>
        </div>
    </div>
    <div class="resp-carte">

        <form class="resp" action="" method="post">
            <h3>Repondre a la contribution</h3>
            @csrf

            <select name="id" id="id" class="form-control">
                <option selected disabled>Nouvel etat</option>
                <option class="col-8" value="1">Accepter</option>
                <option class="col-8" value="2">Accfvcbepter</option>
                <option class="col-8" value="3">dvd</option>
            </select>

            <textarea name="response" class="form-control" id="" cols="30" rows="6">Message a ajoute</textarea>

            <div class="form-group mt-3 mb-2">
                <button type="submit" class="form-control submit-btn btn rounded submit px-3">Envoyer la reponse</button>
            </div>
        </form>
        <div class="carte"></div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('/js/popper.js') }}"></script>
    <script src="{{ asset('/js/theme.js') }}"></script>
@endsection
