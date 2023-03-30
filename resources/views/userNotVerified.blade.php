@extends('master')

@section('title', 'Utilisateurs non vérifiés')

@section('content')
    <p>Voici les utilisateurs non vérifiés :</p>
    @unless(empty($users))
            @foreach ($users as $user)
                <tr>
                    <td>Login: {{$user->login}}</td>
                    <td>Nom: {{$user->nom}}</td>
                    <td>Prénom: {{$user->prenom}}</td>
                    <td><a href="{{ route('user.index', $user->id) }}"role="button">Afficher/modifier</a></td>
                </tr>    
            @endforeach
    @endunless
@endsection