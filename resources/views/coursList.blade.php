@extends('master')

@section('title', 'Les cours')

@section('content')
    <h3>Voici la liste des cours :</h3>
    @auth
        @if(Auth::user()->type == 'admin')
            <a href="/cours/create"><input type="submit" value="Ajouter"></a><br><br>
            <form action="{{route('cours.search')}}" method="post">
                <h4>Rechercher par intitulé :</h4> <input type="text" name="field" value="{{old('field')}}"><br>
                <input type="submit" value="Rechercher">
                @csrf
            </form>
            @if(isset($enseignants))
                <h4>Filtrer par enseignant :</h4>
                @foreach($enseignants as $enseignant)
                    <td><a href="{{ route('cours.list.enseignant', $enseignant->id) }}"role="button">{{$enseignant->nom}} {{$enseignant->prenom}}</a></td><br>
                @endforeach
                <br>
            @endif
        @endif
    @endauth
    @unless(empty($cours))
            @foreach ($cours as $cour)
                <tr>
                    <td>ID: {{$cour->id}}</td>
                    <td>intitulé: {{$cour->intitule}}</td>
                    <td>Formation: {{$cour->formation->intitule}}</td>
                    <td>Enseignant: {{$cour->enseignant->nom}}</td>
                    @auth
                        @if(Auth::user()->type == 'admin')
                            <td><a href="{{ route('cours.index', $cour->id) }}"role="button">Afficher/modifier</a></td>
                        @else
                            <td><a href="{{ route('cours.index', $cour->id) }}"role="button">Afficher</a></td>
                        @endif
                    @endauth
                </tr><br>    
            @endforeach
    @endunless
@endsection