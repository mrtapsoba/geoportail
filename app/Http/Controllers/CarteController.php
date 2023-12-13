<?php

namespace App\Http\Controllers;

use App\Models\Carte;
use App\Models\User;
use Illuminate\Http\Request;

class CarteController extends Controller
{
    //
    public function index()
    {

        $myId = auth()->id();
        $user = User::find($myId);
        if ($user->account_type != "client") {
            return redirect('/');
        }
        $data = Carte::all();
        return view('client.cartes', ["cartes" => $data]);
    }
}
