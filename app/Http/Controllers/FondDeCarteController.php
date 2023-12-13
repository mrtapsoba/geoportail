<?php

namespace App\Http\Controllers;

use App\Models\FondDeCarte;
use App\Models\User;
use Illuminate\Http\Request;

class FondDeCarteController extends Controller
{
    //

    public function  postFondDeCarte(Request $request)
    {
        //dd($request);
        $request->validate([
            'nom' => 'required',
            'cover' => 'required',
            'lien' => 'required',
            'attribution' => 'required'
        ]);

        $uploadedFile = $request->file('cover');
        $filename = time() . $uploadedFile->getClientOriginalName();

        if ($request->hasFile('cover')) {
            $request->file('cover')->move(public_path('images/fonddecartes'), $filename);
        }
        $user = User::find(auth()->id());
        $user->fonddecartes()->create([
            'nom' => $request->nom,
            'image' => 'fonddecartes/' . $filename,
            'lien' => $request->lien,
            'attribution' => $request->attribution
        ]);
        //FondDeCarte::create();

        //dd($filename);
        return back()->with('message', 'Fond de carte ajouter');
    }
}
