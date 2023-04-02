@extends('master')

@section('title', 'Créer un cours')

@section('content')
    <h3>Création d'un cours</h3>
    <form action="{{route('cours.store')}}" method="post">
        Intitulé: <input type="text" name="intitule" value="{{old('intitule')}}"><br>
        Professeur :<br>
        @foreach($enseignants as $enseignant)
            <input type="radio" id="e{{$enseignant->id}}" name="user_id" value="{{$enseignant->id}}">
            <label for="e{{$enseignant->id}}">{{$enseignant->nom ." ".$enseignant->prenom}}</label><br>
        @endforeach
        Formation :<br>
        @foreach($formations as $formation)
            <input type="radio" id="f{{$formation->id}}" name="formation_id" value="{{$formation->id}}">
            <label for="f{{$formation->id}}">{{$formation->intitule}}</label><br>
        @endforeach
        <input type="submit" value="Créer le cours">
        @csrf
    </form>
@endsection