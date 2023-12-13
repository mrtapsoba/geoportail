@extends('layouts.allFrame')


@section('headLinks')
    <link rel="stylesheet" href="/css/thematique.css">
    <link rel="stylesheet" href="/css/ionicons.min.css">
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('fonddecarte')
    class="active"
@endsection
@section('fonddecartePhone')
    class="active"
@endsection

@section('sectiontitle')
    Fond de carte
@endsection

@section('content')
    @include('partials.action_bar')
    @if (session()->get('message'))
        <div class="alert alert-success mt-3">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="produits">
        @forelse ($fonddecarte as $card)
            @include('partials.fond-card')
        @empty
            <span>Aucune thematique</span>
        @endforelse
    </div>


    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center mb-3">Ajout d'un fond de carte</h3>
                    <div class="divide-bar"></div>

                    <form action="{{ route('postFondDeCarte') }}" class="signup-form" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name">Nom du fond de carte</label>
                            <input type="text" name="nom" class="form-control" placeholder="Ex: Vue satellitaire">
                        </div>
                        <div class="form-group mb-2">
                            <label for="name">Lien de la couche</label>
                            <input type="text" name="lien" class="form-control" placeholder="Ex: https://mapbox.com/...">
                        </div>
                        <div class="form-group mb-2">
                            <label for="name">Attribution</label>
                            <input type="text" name="attribution" class="form-control" placeholder="Ex: OpenStreetMap">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Image de couverture</label>
                            <input type="file" name="cover" class="form-control">
                        </div>
                        <div class="form-group mt-3 mb-2">
                            <button type="submit" class="form-control submit-btn btn rounded submit px-3">AJOUTER</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('/js/popper.js') }}"></script>
    <script src="{{ asset('/js/theme.js') }}"></script>
@endsection
