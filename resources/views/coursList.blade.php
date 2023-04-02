@extends('master')

@section('title', 'Les cours')

@section('content')
    <p>Voici la liste des cours :</p>
    <a href="/cours/create"><input type="submit" value="Ajouter"></a><br><br>
    @unless(empty($cours))
            @foreach ($cours as $cour)
                <tr>
                    <td>ID: {{$cour->id}}</td>
                    <td>intitulé: {{$cour->intitule}}</td>
                    <td>Formation: {{$cour->formation->intitule}}</td>
                    <td>Enseignant: {{$cour->enseignant->nom}}</td>
                    <td><a href="{{ route('cours.index', $cour->id) }}"role="button">Afficher/modifier</a></td>
                </tr><br>    
            @endforeach
    @endunless
@endsection