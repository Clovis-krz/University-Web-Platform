<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Formation;

class UserController extends Controller
{
    function index($id)
    {
        $user = User::findOrFail($id);

        return view('userIndex', ['user' => $user]);
    }

    function notVerified()
    {
        $users = User::where('type', '=','null')->get();

        return view('userNotVerified', ['users' => $users]);
    }

    function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'string|max:50',
            "prenom"    => "string|max:50",
            "mdp"    => "string|confirmed",
            "type" => "string",
            ]);

        if (Auth::user()->type == "admin") {
            $user->type = $validated["type"];
        }
        if(isset($validated["nom"]))
        {
            $user->nom = $validated["nom"];
        }
        if (isset($validated["prenom"])) {
            $user->prenom = $validated["prenom"];
        }
        if(isset($validated["mdp"]))
        {
            $user->mdp = Hash::make($validated['mdp']);
        }
        $user->save();
        $request->session()->flash('etat', 'Utilisateur modifié !');
        return redirect("/user/".$id);
    }

    function delete(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $request->session()->flash('etat', 'Compte utilisateur supprimé !');
        return redirect()->route('index');
    }

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
            $formation = Formation::findOrFail($validated2['formation_id']);
            $user->formation()->associate($formation);
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
