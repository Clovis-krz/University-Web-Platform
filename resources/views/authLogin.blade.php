@extends('master')

@section('title', 'Login')

@section('content')
    <h3>S'authentifier</h3>
    <form method="post">
        Login: <input type="text" name="login" value="{{old('login')}}"><br>
        Mot de passe: <input type="password" name="mdp">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection