<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Models\User;

class UserController extends Controller
{
    function registerForm()
    {
        return view('registerForm');
    }
    function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:50',
            "prenom"    => "required|string|max:50",
            "login"  => "required|string|max:30|unique:users",
            "mdp"    => "required|string|confirmed",
            ]);
        $user = new User();
        $user->nom = $validated['nom'];
        $user->prenom = $validated['prenom'];
        $user->login = $validated['login'];
        $user->mdp = Hash::make($validated['mdp']);
        if(isset($request->formation_id))
        {
            $validated2 = $request->validate([
                "formation_id" => "integer"
                ]);
            $user->formation_id = $validated2['formation_id'];
        }
        else
        {
            if($request->has('special'))
            {
                $user->formation_id = null;
            }
            else
            {
                $validated2 = $request->validate([
                    "formation_id" => "integer"
                ]);
            }
        }
        $user->type = "null";

        $user->save();

        Auth::login($user);

        $request->session()->flash('etat', 'Utilisateur crée !');

        return redirect("/");
    }
}
