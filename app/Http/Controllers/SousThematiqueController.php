<?php

namespace App\Http\Controllers;

use App\Models\SousThematique;
use App\Models\Thematique;
use Illuminate\Http\Request;

class SousThematiqueController extends Controller
{
    //
    public function  postSousThematique(Request $request, $id)
    {
        //dd($request);
        $request->validate([
            'nom' => 'required',
            'cover' => 'required'
        ]);

        $thematique = Thematique::findOrFail($id);
        //dd($thematique);
        $uploadedFile = $request->file('cover');
        $filename = time() . $uploadedFile->getClientOriginalName();

        if ($request->hasFile('cover')) {
            //dd("okay");
            $path = $request->file('cover')->move(public_path('images/sousthematiques'), $filename);
        }
        /*
        Storage::disk('local')->put(
            'thematiques/',
            $uploadedFile
        );
        */
        $st = new SousThematique([
            'nom' => $request->nom,
            'image' => 'sousthematiques/' . $filename
        ]);
        $thematique->sousThematiques()->save($st);

        //dd($filename);
        return back()->with('message', 'Sous Thematique ajouter');
    }
}
