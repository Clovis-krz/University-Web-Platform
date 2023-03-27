<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthenticatedSessionController extends Controller
{
    public function formLogin(){
        return view('authLogin');
    }

    public function login(Request $request){
        $request->validate([
        'login' => 'required|string',
        'mdp' => 'required|string'
        ]);
        $credentials = ['login' => $request->input('login'), 'password' => $request->input('mdp')];
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        
        $request->session()->flash('etat', 'Mot de passe incorrect');
        return redirect()->route('login');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
