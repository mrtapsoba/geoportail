<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\Couche;
use App\Models\User;
use Illuminate\Http\Request;
use Shapefile\ShapefileAutoloader;

// Register autoloader
require_once(base_path('') . '/shapefile/ShapefileAutoloader.php');
ShapefileAutoloader::register();

// Import classes
use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileWriter;
use Shapefile\Geometry\Point;


class ContributionController extends Controller
{
    //
    public function index()
    {
        $myId = auth()->id();
        $user = User::find($myId);
        if ($user->account_type == "client") {
            return $this->indexClient();
        } else if ($user->account_type == "Administrateur") {
            return redirect('/');
        }
        $nbAtt = Contribution::where('etat', 'En attente')->count();
        $nbEtude = Contribution::where('etat', 'En etude')->count();
        $nbPriseEnCompte = Contribution::where('etat', 'Prise en compte')->count();
        $nbRejete = Contribution::where('etat', 'Rejetee')->count();

        $data = Contribution::all();
        return view('contribution', ["contributions" => $data, "nbAttente" => $nbAtt, "nbEtude" => $nbEtude, "nbPriseEnCompte" => $nbPriseEnCompte, "nbRejete" => $nbRejete]);
    }

    public function details($id)
    {
        $data = [
            "id" => $id,
            "objet" => "La position de l'hopital",
            "auteur" => "TAPSOBA Abdoul kader",
            "etat" => "En etude",
            "modifDate" => "15-12-2021 a 14:24",
            "addDate" => "15-12-2021 a 14:24",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis vero ratione deleniti facilis, possimus illo beatae, in quam rem hic odio ipsa nulla aliquid! Voluptate, aspernatur? Nulla libero blanditiis esse.",
            "reponse" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, delectus alias nam laborum id consequuntur dolorum sit sunt expedita voluptate quod veritatis eaque similique ullam neque tenetur fugiat molestiae! Cupiditate."
        ];
        return view('contributionDetails', ["details" => $data, "nbAttente" => 02, "nbEtude" => 00, "nbPriseEnCompte" => 01, "nbRejete" => 03]);
    }

    public function indexClient()
    {
        $myId = auth()->id();
        $user = User::find($myId);
        if ($user->account_type == "Producteur") {
            return $this->indexClient();
        } else if ($user->account_type == "Administrateur") {
            return redirect('/');
        }
        $nbAtt = Contribution::where(['etat' => 'En attente', 'user_id' => $myId])->count();
        $nbEtude = Contribution::where(['etat' => 'En etude', 'user_id' => $myId])->count();
        $nbPriseEnCompte = Contribution::where(['etat' => 'Prise en compte', 'user_id' => $myId])->count();
        $nbRejete = Contribution::where(['etat' => 'Rejetee', 'user_id' => $myId])->count();

        $data = Contribution::where('user_id', $myId)->get();
        return view('client.contribution', ["contributions" => $data, "nbAttente" => $nbAtt, "nbEtude" => $nbEtude, "nbPriseEnCompte" => $nbPriseEnCompte, "nbRejete" => $nbRejete, 'actionbar' => true]);
    }

    public function detailsClient($id)
    {
        $data = [
            "id" => $id,
            "objet" => "La position de l'hopital",
            "auteur" => "TAPSOBA Abdoul kader",
            "etat" => "En etude",
            "modifDate" => "15-12-2021 a 14:24",
            "addDate" => "15-12-2021 a 14:24",
            "description" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis vero ratione deleniti facilis, possimus illo beatae, in quam rem hic odio ipsa nulla aliquid! Voluptate, aspernatur? Nulla libero blanditiis esse.",
            "reponse" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequatur, delectus alias nam laborum id consequuntur dolorum sit sunt expedita voluptate quod veritatis eaque similique ullam neque tenetur fugiat molestiae! Cupiditate."
        ];
        return view('client.contributionDetails', ["details" => $data, "nbAttente" => 02, "nbEtude" => 00, "nbPriseEnCompte" => 01, "nbRejete" => 03]);
    }

    public function coucheClient()
    {
        $myId = auth()->id();
        $user = User::find($myId);
        if ($user->account_type == "Producteur") {
            return $this->indexClient();
        } else if ($user->account_type == "Administrateur") {
            return redirect('/');
        }
        $nbAtt = Contribution::where(['etat' => 'En attente', 'user_id' => $myId])->count();
        $nbEtude = Contribution::where(['etat' => 'En etude', 'user_id' => $myId])->count();
        $nbPriseEnCompte = Contribution::where(['etat' => 'Prise en compte', 'user_id' => $myId])->count();
        $nbRejete = Contribution::where(['etat' => 'Rejetee', 'user_id' => $myId])->count();

        $data = Couche::all();
        $par  =  ["couches" => $data, "nbAttente" => $nbAtt, "nbEtude" => $nbEtude, "nbPriseEnCompte" => $nbPriseEnCompte, "nbRejete" => $nbRejete, 'actionbar' => false];
        return view('client.contributionSearch');
    }

    public function delimit($id)
    {
        $c = Couche::find($id);
        $d = new ShpController($c->fichier, [], []);
        $data = $d->getAllData();
        //print_r(json_encode($data));
        //dd($data);
        //$dat = str_replace('&quot;', '', json_encode($data));
        //$dat = str_replace('\ufffd', 'é', json_encode($dat));
        //dd(json_encode($data));
        //print_r(json_encode($data));
        //dd();
        return view('client.contributionSelect', ['data' => json_encode($data), 'coucheId' => $id, 'fichier' => $c->fichier]);
    }

    public function createShp()
    {
        $coords_array = [];
        try {
            // Open Shapefile
            $Shapefile = new ShapefileWriter('/path/to/file.shp');

            // Set shape type
            $Shapefile->setShapeType(Shapefile::SHAPE_TYPE_POINT);

            // Create field structure
            $Shapefile->addNumericField('ID', 10);
            $Shapefile->addCharField('DESC', 25);

            // Write some records (let's pretend we have an array of coordinates)
            foreach ($coords_array as $i => $coords) {
                // Create a Point Geometry
                $Point = new Point($coords['x'], $coords['y']);
                // Set its data
                $Point->setData('ID', $i);
                $Point->setData('DESC', "Point number $i");
                // Write the record to the Shapefile
                $Shapefile->writeRecord($Point);
            }

            // Finalize and close files to use them
            $Shapefile = null;
        } catch (ShapefileException $e) {
            // Print detailed error information
            echo "Error Type: " . $e->getErrorType()
                . "\nMessage: " . $e->getMessage()
                . "\nDetails: " . $e->getDetails();
        }
    }

    public function postDelimit(Request $request)
    {
        //dd($request);
        $request->validate([
            'coucheId' => 'required',
            'objet' => 'required',
            'desc' => 'required',
        ]);
        $uploadedFile = $request->file('file');
        $filename = time() . $uploadedFile->getClientOriginalName();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->move(public_path('files/contributions'), $filename);
        } else {
            return response()->json(['code' => 0, 'message' => 'fichier introuvable']);
        }

        $c = Couche::find($request->coucheId);
        if (!empty($c)) {
            $st = new Contribution([
                'couche_id' => $request->coucheId,
                'objet' => $request->objet,
                'etat' => 'En attente',
                'description' => $request->desc,
                'fichier' => 'contributions/' . $filename,
            ]);
            $myId = auth()->id();
            $user = User::find($myId);
            if ($user->account_type != "client") {
                return redirect('/compte');
            }
            $user->contributions()->save($st);
            return response()->json(['code' => 0, 'message' => 'succes']);
        } else {
            return response()->json(['code' => 1, 'message' => 'couche inexistante']);
        }
    }
}
