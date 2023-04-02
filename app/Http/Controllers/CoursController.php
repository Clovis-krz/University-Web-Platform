<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Models\Cours;
use App\Models\User;
use App\Models\Formation;

class CoursController extends Controller
{

    function index($id)
    {
        $cours = Cours::findOrFail($id);
        $enseignants = User::where('type', '=','enseignant')->get();
        $formations = Formation::get();
        return view('coursIndex', ['cours' => $cours, 'enseignants' => $enseignants, 'formations' => $formations]);
    }

    function list()
    {
        $cours = Cours::get();
        return view('coursList', ['cours' => $cours]);
    }

    function create()
    {
        $enseignants = User::where('type', '=','enseignant')->get();
        $formations = Formation::get();
        return view('coursForm', ['enseignants' => $enseignants, 'formations' => $formations]);
    }

    function update(Request $request, $id)
    {
        $validated = $request->validate([
            'intitule' => 'string|max:100',
            "user_id"    => "integer",
            "formation_id"    => "integer",
        ]);
        
        $cours = Cours::findOrFail($id);
        $cours->intitule = $validated['intitule'];
        $cours->user_id = User::where('type', '=', 'enseignant')->findOrFail($validated['user_id'])->id;
        $cours->formation_id = Formation::findOrFail($validated['formation_id'])->id;

        $cours->save();

        $request->session()->flash('etat', 'Cours mis à jour !');

        return redirect("/cours/".$cours->id);
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|max:100',
            "user_id"    => "required|integer",
            "formation_id"    => "required|integer",
        ]);
        $cours = new Cours();
        $cours->intitule = $validated['intitule'];
        $cours->user_id = User::where('type', '=', 'enseignant')->findOrFail($validated['user_id'])->id;
        $cours->formation_id = Formation::findOrFail($validated['formation_id'])->id;

        $cours->save();

        $request->session()->flash('etat', 'Cours créée !');

        return redirect("/cours/".$cours->id);
    }

    function destroy(Request $request, $id)
    {
        $cours = Cours::findOrFail($id);
        $cours->delete();

        $request->session()->flash('etat', 'Cours supprimé !');

        return redirect("/cours/list");
    }
}
