<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Profile extends Controller
{
    //
    public function index()
    {

        $user = User::find(auth()->id());
        $data = [
            "user" => $user
        ];
        if ($user->account_type == "Producteur") {
            return view('profile', $data);
        } else if ($user->account_type == "client") {
            return view('client.profile', $data);
        }
    }
}
