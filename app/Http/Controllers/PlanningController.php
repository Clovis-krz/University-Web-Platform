<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Planning;
use App\Models\Cours;
use App\Models\User;
use Auth;

class PlanningController extends Controller
{
    function list()
    {
        $plannings = Planning::get();
        $cours = Cours::get();
        return view('planningList', ['plannings' => $plannings, 'cours' => $cours]);
    }

    function listTeacher()
    {
        $plannings = Planning::get();
        $cours = Auth::user()->enseigne()->get();
        $this->authorize('viewTeacher', $plannings[0]);
        $return_plannings = []; 
        foreach($plannings as $planning)
        {
            if($planning->cours->user_id == Auth::user()->id)
            {
                array_push($return_plannings, $planning);
            }
        }
        return view('planningList', ['plannings' => $return_plannings, 'cours' => $cours]);
    }

    function listTeacherByCourse($id)
    {
        $plannings = Planning::get();
        $cours = Auth::user()->enseigne()->get();
        $this->authorize('viewTeacher', $plannings[0]);
        $return_plannings = []; 
        foreach($plannings as $planning)
        {
            if($planning->cours->user_id == Auth::user()->id && $planning->cours_id == $id)
            {
                array_push($return_plannings, $planning);
            }
        }
        return view('planningList', ['plannings' => $return_plannings, 'cours' => $cours]);
    }

    function listStudent()
    {
        $plannings = Planning::get();
        $this->authorize('viewStudent', $plannings[0]);
        $courses = Auth::user()->cours()->get();
        $return_plannings = [];
        foreach($plannings as $planning)
        {
            foreach($courses as $course)
            {
                if($course->id == $planning->cours_id)
                {
                    array_push($return_plannings, $planning);
                }
            }
        }
        return view('planningList', ['plannings' => $return_plannings, 'cours' => $courses]);
    }

    function listStudentByCourse($id)
    {
        $plannings = Planning::get();
        $this->authorize('viewStudent', $plannings[0]);
        $courses = Auth::user()->cours()->get();
        $return_plannings = [];
        foreach($plannings as $planning)
        {
            foreach($courses as $course)
            {
                if($course->id == $planning->cours_id && $planning->cours_id == $id)
                {
                    array_push($return_plannings, $planning);
                }
            }
        }
        return view('planningList', ['plannings' => $return_plannings, 'cours' => $courses]);
    }
    
    function createAdmin()
    {
        $cours = Cours::get();
        return view('planningForm', ['cours' => $cours]);
    }

    function editAdmin($id)
    {
        $planning = Planning::findOrFail($id);
        $cours = Cours::get();
        return view('planningIndex', ['planning' => $planning, 'cours' => $cours]);
    }

    function createTeacher()
    {
        $planning = new Planning();
        $this->authorize('create', $planning);
        $cours = Auth::user()->enseigne()->get();
        return view('planningForm', ['cours' => $cours]);
    }

    function editTeacher($id)
    {
        $planning = Planning::findOrFail($id);
        $this->authorize('update', $planning);
        $cours = Auth::user()->enseigne()->get();
        return view('planningIndex', ['planning' => $planning, 'cours' => $cours]);
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            "cours_id"    => "required|integer",
            "date_debut"  => "required|date",
            "date_fin" => "required|date|after:date_debut"
        ]);
        $planning = new Planning();
        $this->authorize('create', $planning);
        $planning->cours_id = $validated['cours_id'];
        $planning->date_debut = $validated['date_debut'];
        $planning->date_fin = $validated['date_fin'];

        $planning->save();

        $request->session()->flash('etat', 'Planning crée !');

        if(Auth::user()->type == 'admin')
        {
            return redirect("/planning/list");
        }
        else if(Auth::user()->type == 'enseignant')
        {
            return redirect("/planning/list/teacher");
        }
        else
        {
            return redirect("/");
        }
    }

    function update(Request $request, $id)
    {
        $validated = $request->validate([
            "cours_id"    => "integer",
            "date_debut"  => "date",
            "date_fin" => "date"
        ]);
        $planning = Planning::findOrFail($id);
        $this->authorize('update', $planning);
        if(isset($validated['cours_id']))
        {
            $planning->cours_id = $validated['cours_id'];
        }    
        if(isset($validated['date_debut']))
        {
            $planning->date_debut = $validated['date_debut'];
        }
        if(isset($validated['date_fin']))
        {
            $planning->date_fin = $validated['date_fin'];
        }
        
        $planning->save();

        $request->session()->flash('etat', 'Planning mis à jour !');

        if(Auth::user()->type == 'admin')
        {
            return redirect("/planning/list");
        }
        else if(Auth::user()->type == 'enseignant')
        {
            return redirect("/planning/list/teacher");
        }
        else
        {
            return redirect("/");
        }
    }

    function destroy(Request $request, $id)
    {
        $planning = Planning::findOrFail($id);
        $this->authorize('delete', $planning);
        $planning->delete();

        $request->session()->flash('etat', 'Séance de cours supprimé !');

        if(Auth::user()->type == 'admin')
        {
            return redirect("/planning/list");
        }
        else if(Auth::user()->type == 'enseignant')
        {
            return redirect("/planning/list/teacher");
        }
        else
        {
            return redirect("/");
        }
    }
}
