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
    @if (session()->get('message'))
        <div class="alert alert-success mt-3">
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="produits">
        @if (count($demandes) > 0)
            <table>
                <thead>
                    <tr>
                        <th>Num</th>
                        <th>Objet</th>
                        <th>Auteur</th>
                        <th>Etat</th>
                        <th>Date de modification</th>
                        <th>Date d'ajout</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($demandes as $demande)
                        @php
                            $i++;
                        @endphp
                        <tr>
                            <th><a href="{{ route('demandedetails', ['id' => $demande->id]) }}">{{ $i }}
                                </a></th>
                            <td><a
                                    href="{{ route('demandedetails', ['id' => $demande->id]) }}">{{ $demande->objet }}</a>
                            </td>
                            <td><a
                                    href="{{ route('demandedetails', ['id' => $demande->id]) }}">{{ $demande->auteur }}</a>
                            </td>
                            <td><a href="{{ route('demandedetails', ['id' => $demande->id]) }}">{{ $demande->etat }}</a>
                            </td>
                            <td><a
                                    href="{{ route('demandedetails', ['id' => $demande->id]) }}">{{ $demande->updated_at->format('d M Y à H:i') }}</a>
                            </td>
                            <td><a
                                    href="{{ route('demandedetails', ['id' => $demande->id]) }}">{{ $demande->created_at->format('d M Y à H:i') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-success mt-3">
                <span>Aucune Demande</span>
            </div>
        @endif
    </div>


    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="text-center mb-3">Demande de donnees geographiques</h3>
                    <div class="divide-bar"></div>
                    <div class="indices">
                        <p>Veuillez telecharger la fiche de demande et la remplir puis nous l'envoyee par ce formulaire</p>
                        <a href="#form"><i class="ind-ic fas fa-download"></i></a>
                    </div>

                    <div class="form"><span>Formulaire</span></div>
                    <form action="{{ route('demandepost') }}" method="POST" class="signup-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <input name="email" value="{{ old('email') }}" type="email" class="form-control"
                                placeholder="Adresse email">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <input name="objet" value="{{ old('objet') }}" type="text" class="form-control"
                                placeholder="Objet de la demande">
                            @if ($errors->has('objet'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('objet') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <textarea name="mot_cle" class="form-control" id="" cols="30" rows="2" placeholder="Mots cle">{{ old('mot_cle') }}</textarea>
                            @if ($errors->has('mot_cle'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mot_cle') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <label for="fiche_demande">Fiche de la demande</label>
                            <input name="fiche_demande" type="file" placeholder="fiche de la demande"
                                class="form-control">
                            @if ($errors->has('fiche_demande'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('fiche_demande') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group mb-2">
                            <label for="email">Document justificatif du demandeur</label>
                            <input name="justificatifs" type="file" placeholder="fiche de la demande"
                                class="form-control">
                            @if ($errors->has('justificatifs'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('justificatifs') }}</strong>
                                </span>
                            @endif
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
