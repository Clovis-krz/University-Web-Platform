@extends('master')

@section('title', 'Liste des formations')

@section('content')
    <h3>Liste des formations :</h3>
    <a href="{{ route('formation.create') }}"><input type="submit" value="Ajouter"></a><br><br>
    @unless (empty($formations))
        <table>
            @foreach($formations as $formation)
                <tr>
                    <td> Id: {{$formation->id}}</td>
                    <td> Intitulé: {{$formation->intitule}}</td>
                    <td><a href="{{ route('formation.edit', $formation->id) }}"role="button">Afficher/modifier</a></td>
                </tr>
            @endforeach
        </table>
    @endunless
@endsection