<?php

namespace App\Http\Controllers;

use App\Models\Thematique;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ThematiqueController extends Controller
{
    //

    public function  postThematique(Request $request)
    {
        //dd($request);
        $request->validate([
            'nom' => 'required',
            'cover' => 'required'
        ]);

        $uploadedFile = $request->file('cover');
        $filename = time() . $uploadedFile->getClientOriginalName();

        if ($request->hasFile('cover')) {
            $dest = '/public/images/thematiques';
            $path = $request->file('cover')->move(public_path('images/thematiques'), $filename);
        }
        /*
        Storage::disk('local')->put(
            'thematiques/',
            $uploadedFile
        );
        */

        Thematique::create([
            'nom' => $request->nom,
            'image' => 'thematiques/' . $filename
        ]);

        //dd($filename);
        return back()->with('message', 'Thematique ajouter');
    }
}
