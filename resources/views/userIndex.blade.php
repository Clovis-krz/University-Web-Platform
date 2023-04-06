@extends('master')

@section('title', 'Compte administrateur')

@section('content')
    <h3>Voci les informations du profil :</h3>
    @unless(empty($user))
            ID: {{$user->id}}<br>
            Login: {{$user->login}}<br>
            @if($user->type == "etudiant")
                Formation: {{$user->formation()->first()->intitule}}<br>
            @endif
            <form action="{{route('user.edit', $user->id)}}" method="post">
                Prénom: <input type="text" name="prenom" value="{{$user->prenom}}"><br>
                Nom: <input type="text" name="nom" value="{{$user->nom}}"><br>
                <input type="submit" value="Modifier">
                @csrf
            </form>
            <form action="{{route('user.edit', $user->id)}}" method="post">
                Changer le mot de passe: <input type="password" name="mdp">
                Confirmer le mot de passe: <input type="password" name="mdp_confirmation">
                <input type="submit" value="Changer le mot de passe">
                @csrf
            </form>
            @auth
                @if(Auth::user()->type == "admin")
                    <form action="{{route('user.edit', $user->id)}}" method="post">
                        <input type="radio" id="not" name="type" value="null" {{ $user->type == "null" ? "checked" : null }}>
                        <label for="not">Non vérifié</label><br>
                        <input type="radio" id="admin" name="type" value="admin" {{ $user->type == "admin" ? "checked" : null }}>
                        <label for="admin">Administrateur</label><br>
                        <input type="radio" id="enseignant" name="type" value="enseignant" {{ $user->type == "enseignant" ? "checked" : null }}>
                        <label for="enseignant">Enseignant</label><br>
                        <input type="radio" id="etudiant" name="type" value="etudiant" {{ $user->type == "etudiant" ? "checked" : null }}>
                        <label for="etudiant">Etudiant</label><br>
                        <input type="submit" value="Modifier status">
                        @csrf
                    </form>
                    <form action="{{route('user.destroy', $user->id)}}" method="post">
                        @method('delete')
                        <input type="submit" value="Supprimer">
                        @csrf
                    </form>
                @endif
            @endauth
        @else
    @endunless
@endsection