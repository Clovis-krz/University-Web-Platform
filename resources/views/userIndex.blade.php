@extends('master')

@section('title', 'Compte administrateur')

@section('content')
    <p>Voci les informations de votre profil :</p>
    @unless(empty($user))
            ID: {{$user->id}}<br>
            Login: {{$user->login}}<br>
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