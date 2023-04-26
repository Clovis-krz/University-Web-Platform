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
    @unless(empty($cours))
        @auth
            @if(Auth::user()->type != 'admin')
                <h4>Filtrer par cours :</h4>
                @foreach($cours as $cour)
                    @if(Auth::user()->type == 'enseignant')
                        <a href="{{ route('planning.list.teacher.course', $cour->id) }}"role="button">{{$cour->intitule}}</a>
                    @endif
                    @if(Auth::user()->type == 'etudiant')
                        <a href="{{ route('planning.list.student.course', $cour->id) }}"role="button">{{$cour->intitule}}</a>
                    @endif
                <br>
                @endforeach
                @if(Auth::user()->type == 'enseignant')
                    <a href="{{ route('planning.list.teacher')}}"role="button">Tous</a>
                @endif
                @if(Auth::user()->type == 'etudiant')
                    <a href="{{ route('planning.list.student')}}"role="button">Tous</a>
                @endif
                <h4>Filtrer par semaine :</h4>
                @if(Auth::user()->type == 'etudiant')
                    <form action="{{route('planning.list.student.week')}}" method="post">
                        <input id="week" type="week" name="week" />
                        <input type="submit" value="Rechercher">
                        @csrf
                    </form>
                @endif
                @if(Auth::user()->type == 'enseignant')
                    <form action="{{route('planning.list.teacher.week')}}" method="post">
                        <input id="week" type="week" name="week" />
                        <input type="submit" value="Rechercher">
                        @csrf
                    </form>
                @endif
                <br>
                <br>
            @endif
        @endauth
    @endunless
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