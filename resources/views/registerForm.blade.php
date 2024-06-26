@extends('master')

@section('title', 'Créer un compte')

@section('content')
    <h3>Création d'un compte</h3>
    <form action="{{route('register')}}" method="post">
        Nom: <input type="text" name="nom" value="{{old('nom')}}"><br>
        Prénom: <input type="text" name="prenom" value="{{old('prenom')}}"><br>
        Login: <input type="text" name="login" value="{{old('login')}}"><br>
        Professeur ou Administrateur: 
        <label for="special"></label>
        <input type="checkbox" id="special" name="special"><br>
        Formation (sauf si Professeur ou Administrateur):<br>
        @foreach($formations as $formation)
            <input type="radio" id="{{$formation->id}}" name="formation_id" value="{{$formation->id}}">
            <label for="{{$formation->id}}">{{$formation->intitule}}</label><br>
        @endforeach
        Mot de passe: <input type="password" name="mdp"><br>
        Confirmation Mot de passe: <input type="password" name="mdp_confirmation"><br>
        <input type="submit" value="Créer le compte">
        @csrf
    </form>
@endsection