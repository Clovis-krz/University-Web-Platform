@extends('master')

@section('title', 'Utilisateurs vérifiés')

@section('content')
    <p>Voici les utilisateurs vérifiés:</p>
    <a href="/register"><input type="submit" value="Ajouter"></a><br><br>
    <a href="/user/not-verified"><input type="submit" value="Non vérifiés"></a><br><br>
    @unless(empty($users))
            @foreach ($users as $user)
                <tr>
                    <td>Login: {{$user->login}}</td>
                    <td>Nom: {{$user->nom}}</td>
                    <td>Prénom: {{$user->prenom}}</td>
                    <td><a href="{{ route('user.index', $user->id) }}"role="button">Afficher/modifier</a></td>
                </tr><br>    
            @endforeach
    @endunless
@endsection