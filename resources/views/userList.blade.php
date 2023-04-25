@extends('master')

@section('title', 'Utilisateurs vérifiés')

@section('content')
    <h3>Voici les utilisateurs vérifiés:</h3>
    <a href="/register"><input type="submit" value="Ajouter"></a><br><br>
    <a href="/user/list/etudiant"><input type="submit" value="Etudiants"></a><br><br>
    <a href="/user/list/enseignant"><input type="submit" value="Enseignants"></a><br><br>
    <a href="/user/not-verified"><input type="submit" value="Non vérifiés"></a><br><br>
    <form action="{{route('user.search')}}" method="post">
        Rechercher par nom/prenom/login: <input type="text" name="field" value="{{old('field')}}"><br>
        <input type="submit" value="Rechercher">
        @csrf
    </form>
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