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
    Thematique
@endsection

@section('content')
    @include('partials.action_bar')
    @if (session()->get('message'))
        <div class="alert alert-success mt-3">
            {{ session()->get('message') }}
        </div>
    @endif
    @if (count($thematiques) > 0)
        <div class="produits">
            @foreach ($thematiques as $card)
                @include('partials.prod-card')
            @endforeach
        </div>
    @else
        <div class="alert alert-success mt-3">
            <span>Aucune thematique</span>
        </div>
    @endif


    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center mb-3">Ajout d'une thematique</h3>
                    <div class="divide-bar"></div>

                    <form method="post" action="{{ route('postthematique') }}" class="signup-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="name">Nom de la thematique</label>
                            <input name="nom" type="text" value="{{ old('nom') }}" class="form-control"
                                placeholder="Ex: Reseaux routiers">
                            @if ($errors->has('nom'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nom') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Image de couverture</label>
                            <input name="cover" accept="image/*" type="file" class="form-control">
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
