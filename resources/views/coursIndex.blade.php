@extends('master')

@section('title', 'modifier un cours')

@section('content')
    @auth
        @if(Auth::user()->type == 'admin')
            <h3>Modification d'un cours</h3>
            <form action="{{route('cours.update', $cours->id)}}" method="post">
                @method('put')
                Intitulé: <input type="text" name="intitule" value="{{$cours->intitule}}"><br>
                Professeur :<br>
                @foreach($enseignants as $enseignant)
                    <input type="radio" id="e{{$enseignant->id}}" name="user_id" value="{{$enseignant->id}}" {{ $cours->user_id == $enseignant->id ? "checked" : null }}>
                    <label for="e{{$enseignant->id}}">{{$enseignant->nom ." ".$enseignant->prenom}}</label><br>
                @endforeach
                Formation :<br>
                @foreach($formations as $formation)
                    <input type="radio" id="f{{$formation->id}}" name="formation_id" value="{{$formation->id}}" {{ $cours->formation_id == $formation->id ? "checked" : null }}>
                    <label for="f{{$formation->id}}">{{$formation->intitule}}</label><br>
                @endforeach
                <input type="submit" value="Modifier le cours">
                @csrf
            </form>
            <form action="{{route('cours.destroy', $cours->id)}}" method="post">
                @method('delete')
                <input type="submit" value="Supprimer">
                @csrf
            </form>
        @endif
        @if(Auth::user()->type == 'etudiant')
            <h3>Description du cours</h3>
            Intitulé: {{$cours->intitule}}<br>
            Professeur : {{$cours->enseignant->nom ." ".$cours->enseignant->prenom}}<br>
            Formation : {{$cours->formation->intitule}}<br>
            @if($is_sub)
                <form action="{{route('cours.unsubscribe', $cours->id)}}" method="post">
                    <input type="submit" value="Se désinscrire">
                    @csrf
                </form>
            @else
                <form action="{{route('cours.subscribe', $cours->id)}}" method="post">
                    <input type="submit" value="S'inscrire">
                    @csrf
                </form>
            @endif

            
        @endif

        @if(Auth::user()->type == 'enseignant')
            <h3>Description du cours</h3>
            Intitulé: {{$cours->intitule}}<br>
            Professeur : {{$cours->enseignant->nom ." ".$cours->enseignant->prenom}}<br>
            Formation : {{$cours->formation->intitule}}<br>
        @endif
    @endauth
@endsection