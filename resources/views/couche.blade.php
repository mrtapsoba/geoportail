@extends('layouts.allFrame')


@section('headLinks')
    <link rel="stylesheet" href="/css/couche.css">

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
    Couche
@endsection

@section('content')
    @include('partials.action_bar')
    @if (session()->get('message'))
        <div class="alert alert-success mt-3">
            {{ session()->get('message') }}
        </div>
    @endif

    @if (count($couches) > 0)
        <div class="produits-list">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom du produit</th>
                        <th>Fichier</th>
                        <th>Annee</th>
                        <th>Description</th>
                        <th>Date d'ajout</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($couches as $couche)
                        <tr>
                            <th><a href="commande/details/{{ $couche->id }}">{{ $couche->id }}</a></th>
                            <td><a href="commande/details/{{ $couche->id }}">{{ $couche->nom }}</a></td>
                            <td><a href="commande/details/{{ $couche->id }}">{{ $couche->fichier }}</a></td>
                            <td><a href="commande/details/{{ $couche->id }}">{{ $couche->annee_prod }}</a></td>
                            <td><a href="commande/details/{{ $couche->id }}">
                                    {{ \Illuminate\Support\Str::limit($couche->description, 50, $end = '...') }}</a></td>
                            <td><a
                                    href="commande/details/{{ $couche->id }}">{{ $couche->created_at->format('d M Y à H:i') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-success mt-3">
            <span>Aucune couche</span>
        </div>
    @endif

    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center mb-3">Ajout d'une couche</h3>
                    <div class="divide-bar"></div>
                    <form method="POST" action="{{ route('postCouche', ['id' => $sousthematik->id]) }}"
                        class="signup-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <input type="text" name="nom" class="form-control" placeholder="Nom de la couche">
                        </div>
                        <div class="form-group mb-2">
                            <label for="shapefile">Fichier Zip contenant les fichiers correspondants</label>
                            <input name="shapefile" id="shapefile" type="file" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <input name="anneeprod" type="number" class="form-control" min="1900" max="2099" step="1"
                                placeholder="Annee de production" />
                        </div>
                        <div class="form-group mb-2">
                            <textarea name="desc" name="description" class="form-control" id="" cols="30" rows="5" placeholder="Description"></textarea>
                        </div>
                        <div class="form-group mt-3 mb-2">
                            <button type="submit" class="form-control submit-btn btn rounded submit px-3">ENVOYER</button>
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
