<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Formation;

class FormationController extends Controller
{
    function list()
    {
        $formations = Formation::get();
        return view('formationList', ['formations' => $formations]);
    }

    function create()
    {
        return view('formationCreate');
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            "intitule"    => "required|string|max:50",
        ]);
        $formation = new Formation();
        $formation->intitule = $validated['intitule'];

        $formation->save();

        $request->session()->flash('etat', 'Formation crée !');

        return redirect("/formation/edit/".$formation->id);
    }

    function edit($id)
    {
        $formation = Formation::findOrFail($id);
        return view('formationEdit', ['formation' => $formation]);
    }

    function update(Request $request, $id)
    {
        $validated = $request->validate([
            "intitule"    => "required|string|max:50",
        ]);
        $formation = Formation::findOrFail($id);

        $formation->intitule = $validated['intitule'];

        $formation->save();

        $request->session()->flash('etat', 'Formation mise à jour !');

        return redirect("/formation/edit/".$formation->id);
    }

    function destroy(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();

        $request->session()->flash('etat', 'Formation supprimé !');

        return redirect("/formation");
    }
}
