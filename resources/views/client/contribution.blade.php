@extends('layouts.allFrameClient')


@section('headLinks')
    <link rel="stylesheet" href="/css/contribution.css">

    <link rel="stylesheet" href="/css/ionicons.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <style>
        .ic.plus {
            font-size: 20px;
            color: black;
            margin: auto 8px
        }

        .ic.plus:hover {
            color: #37bd37
        }
    </style>
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
    <div class="produits">
        @if (count($contributions) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Num</th>
                        <th>Objet</th>
                        <th>Etat</th>
                        <th>Date de modification</th>
                        <th>Date d'ajout</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contributions as $contribution)
                        <tr>
                            <th><a href="{{ route('contributiondetails', ['id' => $contribution->id]) }}">
                                    {{ $contribution['id'] }} </a></th>
                            <td><a
                                    href="{{ route('contributiondetails', ['id' => $contribution->id]) }}">{{ $contribution->objet }}</a>
                            </td>
                            <td><a
                                    href="{{ route('contributiondetails', ['id' => $contribution->id]) }}">{{ $contribution->etat }}</a>
                            </td>
                            <td><a
                                    href="{{ route('contributiondetails', ['id' => $contribution->id]) }}">{{ $contribution->updated_at->format('d M Y à H:i') }}</a>
                            </td>
                            <td><a
                                    href="{{ route('contributiondetails', ['id' => $contribution->id]) }}">{{ $contribution->created_at->format('d M Y à H:i') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-success mt-3">
                <span>Aucune Contribution</span>
            </div>
        @endif
    </div>


    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center mb-3">Ajout d'une couche</h3>
                    <div class="divide-bar"></div>
                    <form action="#" class="signup-form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" placeholder="Nom de la couche">
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Fichier Zip contenant les fichiers correspondants</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <input type="date" class="form-control" placeholder="Annee de production">
                        </div>
                        <div class="form-group mb-2">
                            <textarea name="description" class="form-control" id="" cols="30" rows="5" placeholder="Description"></textarea>
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
