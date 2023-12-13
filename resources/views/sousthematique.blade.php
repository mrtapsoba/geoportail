@extends('layouts.allFrame')


@section('headLinks')
    <link rel="stylesheet" href="/css/thematique.css">

    <link rel="stylesheet" href="/css/ionicons.min.css">
    <link rel="stylesheet" href="/css/style.css">
@endsection

@section('thematique')
    class="active"
@endsection
@section('thematiquePhone')
    class="active"
@endsection

@section('sectiontitle')
    Sous Thematique
@endsection

@section('content')
    @include('partials.action_bar')
    @if (session()->get('message'))
        <div class="alert alert-success mt-3">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="produits">
        @forelse ($sousthematiques as $card)
            @include('partials.prod-card2')
        @empty
            <div class="alert alert-success mt-3">
                <span>Aucune sous thematique</span>
            </div>
        @endforelse
    </div>


    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center mb-3">Ajout d'une sous thematique</h3>
                    <div class="divide-bar"></div>
                    <form method="post" action="{{ route('postsousthematique', ['id' => $thematik]) }}"
                        class="signup-form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $thematik }}">
                        <div class="form-group mb-2">
                            <label for="name">Nom de la sous thematique</label>
                            <input type="text" name="nom" class="form-control" placeholder="Ex: Routes terrestres">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Image de couverture</label>
                            <input accept="image/*" type="file" name="cover" class="form-control">
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
