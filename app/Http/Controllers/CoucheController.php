<?php

namespace App\Http\Controllers;

use App\Models\Couche;
use App\Models\FondDeCarte;
use App\Models\SousThematique;
use App\Models\Thematique;
use Illuminate\Http\Request;
use App\Unzipper\Unzipper;

class CoucheController extends Controller
{
    //
    public function thematique()
    {
        $data = Thematique::all();
        return view('thematique', ["thematiques" => $data, "nbData" => 04]);
    }
    public function sousthematique($id)
    {
        $thematik = Thematique::findOrFail($id);
        $data = SousThematique::where('thematique_id', $id)->get();
        //dd($data[0]->nom);
        if ($data == null) $data = [];
        //dd($data);
        return view('sousthematique', ["sousthematiques" => $data, "nbData" => 02, "thematiqueid" => $thematik->nom, "thematik" => $id]);
    }
    public function couche($thematik, $sousthematik)
    {

        $thematique = Thematique::findOrFail($thematik);
        $sousthematique = SousThematique::findOrFail($sousthematik);
        $data = [
            [
                "id" => 01,
                "fichier" => "carte.png",
                "nom" => "Routes nationales",
                "description" => "lorem ipsum dolor",
                "date" => "12 mai 2022"
            ],
            [
                "id" => 02,
                "fichier" => "carte.png",
                "nom" => "Routes regionales",
                "description" => "lorem ipsum dolor",
                "date" => "12 mai 2022"
            ],
            [
                "id" => 03,
                "fichier" => "carte3.jpg",
                "nom" => "Routes departementales",
                "description" => "lorem ipsum dolor",
                "date" => "12 mai 2022"
            ],
        ];
        $data = Couche::where('sous_thematique_id', $sousthematik)->get();

        return view('couche', ["couches" => $data, "nbData" => 02, "thematik" => $thematique->nom, "sousthematik" => $sousthematique]);
    }

    public function fonddecarte()
    {
        $data = FondDeCarte::all();
        return view('fonddecarte', ["fonddecarte" => $data, "nbData" => 02]);
    }
    public function parseMyString($myString)
    {
        $arrayFromString = str_split($myString);
        $finalString = "";
        $tabNumber = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        //var_dump($myString);
        //var_dump($arrayFromString);
        while (in_array($arrayFromString[0], $tabNumber)) array_shift($arrayFromString);
        //var_dump($arrayFromString);
        $tail = count($arrayFromString);
        while ($tail > 0) {
            $finalString .= array_shift($arrayFromString);
            $tail = count($arrayFromString);
        }
        return $finalString;
    }
    public function  postCouche(Request $request, $id)
    {
        //dd($request);
        $request->validate([
            'nom' => 'required',
            'shapefile' => 'required',
            'desc' => 'required',
            'anneeprod' => 'required',

        ]);

        $sousthematique = SousThematique::findOrFail($id);
        $uploadedFile = $request->file('shapefile');
        $filename = time() . $this->parseMyString($uploadedFile->getClientOriginalName());

        if ($request->hasFile('shapefile')) {
            $path = $request->file('shapefile')->move(public_path('files/zip'), $filename);
        }
        $foldname = $filename;
        if ($path) {
            $unzipper  = new Unzipper;
            $foldname = str_replace('.zip', '', $filename);
            $foldname = str_replace('.rar', '', $foldname);
            $unzipper->prepareExtraction(public_path('files/zip') . "/" . $filename, public_path('files/shapefiles/') . "/" . $foldname);
        }

        $st = new Couche([
            'nom' => $request->nom,
            'annee_prod' => $request->anneeprod,
            'description' => $request->desc,
            'fichier' => $foldname
        ]);
        $sousthematique->couches()->save($st);

        //dd($filename);
        return back();
    }
}
