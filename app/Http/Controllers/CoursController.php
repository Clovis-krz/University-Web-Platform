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
        $user = Auth::user();
        $enseignants = User::where('type', '=','enseignant')->get();
        $formations = Formation::get();
        $is_sub = false;
        if($user->type == 'etudiant')
        {
            foreach($user->cours as $user_cours)
            {
                if($user_cours->pivot->cours_id == $cours->id)
                {
                    $is_sub = true;
                }
            }
                
        }
        return view('coursIndex', ['cours' => $cours, 'enseignants' => $enseignants, 'formations' => $formations, 'is_sub' => $is_sub]);
    }

    //COURSES LIST IN WHICH I AM SUBSCRIBED
    function my()
    {
        $user = Auth::user();
        $courses = Cours::get();
        $this->authorize('subscriptionlist', $courses[0]);
        $my_courses = null;
        foreach($courses as $course){
            foreach($course->user as $c_user)
            {
                if($c_user->pivot->user_id == $user->id)
                {
                    $my_courses[$course->id] = $course;
                } 
            }
            
        }
        return view('coursList', ['cours' => $my_courses]);
    }

    //COURSES LIST FROM MY FORMATION
    function my_formation()
    {
        $user = Auth::user();
        
        $cours = Cours::where('formation_id', '=', $user->formation_id)->get();
        $this->authorize('myformationlist', $cours[0]);
        return view('coursList', ['cours' => $cours]);
    }

    //COURSES LIST I TEACH
    function i_teach()
    {
        $user = Auth::user();
        $cours = Cours::where('user_id', '=', $user->id)->get();
        $this->authorize('iteach', $cours[0]);
        return view('coursList', ['cours' => $cours]);
    }

    function list()
    {
        $cours = Cours::get();
        return view('coursList', ['cours' => $cours]);
    }

    function search(Request $request)
    {
        $validated = $request->validate([
            'field' => 'string|max:100'
        ]);
        $cours = Cours::where('intitule','like',"%{$validated['field']}%")->get();
        return view('coursList', ['cours' => $cours]);
    }

    function create()
    {
        $enseignants = User::where('type', '=','enseignant')->get();
        $formations = Formation::get();
        return view('coursForm', ['enseignants' => $enseignants, 'formations' => $formations]);
    }

    function subscribe(Request $request, $cours_id)
    {
        $user = Auth::user();

        $cours = Cours::findOrFail($cours_id);

        $this->authorize('subscribe', $cours);

        $cours->user()->attach($user);

        $request->session()->flash('etat', 'Inscription au cours effectué !');

        return redirect("/cours/".$cours->id);
    }

    function unsubscribe(Request $request, $cours_id)
    {
        $user = Auth::user();

        $cours = Cours::findOrFail($cours_id);

        $this->authorize('unsubscribe', $cours);

        $cours->user()->detach($user);

        $request->session()->flash('etat', 'Désinscription au cours effectué !');

        return redirect("/cours/".$cours->id);
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
