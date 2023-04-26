@extends('master')

@section('title', 'Les plannings')

@section('content')
    <h3>Voici la liste des séances de cours :</h3>
    @auth
        @if(Auth::user()->type == 'admin')
            <a href="/planning/create/admin"><input type="submit" value="Ajouter"></a><br><br>
        @endif
        @if(Auth::user()->type == 'enseignant')
            <a href="/planning/create/teacher"><input type="submit" value="Ajouter"></a><br><br>
        @endif
    @endauth
    @unless(empty($plannings))
            @foreach ($plannings as $planning)
                <tr>
                    <td>ID: {{$planning->id}}</td>
                    <td>Cours intitulé: {{$planning->cours->intitule}}</td>
                    <td>Date de début: {{$planning->date_debut}}</td>
                    <td>Date de fin: {{$planning->date_fin}}</td>
                    @auth
                        @if(Auth::user()->type == 'admin')
                            <td><a href="{{ route('planning.edit.admin', $planning->id) }}"role="button">Afficher/modifier</a></td>
                        @endif
                        @if(Auth::user()->type == 'enseignant')
                            <td><a href="{{ route('planning.edit.teacher', $planning->id) }}"role="button">Afficher/modifier</a></td>
                        @endif
                    @endauth
                </tr><br>    
            @endforeach
    @endunless
@endsection