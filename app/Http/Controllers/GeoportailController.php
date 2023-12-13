<?php

namespace App\Http\Controllers;

use App\Models\Couche;
use App\Models\FondDeCarte;
use App\Models\SousThematique;
use App\Models\Thematique;
use Illuminate\Http\Request;

class GeoportailController extends Controller
{
    //
    public function index()
    {
        $fonds = FondDeCarte::all();
        $thematiqueListe = Thematique::all();
        $sousThemeListe = SousThematique::all();
        $coucheListe = Couche::all();
        return view('geoportail', [
            'fondListe' => $fonds,
            'thematiqueListe' => $thematiqueListe,
            'sousThemeListe' => $sousThemeListe,
            'coucheListe' => $coucheListe
        ]);
    }
}
