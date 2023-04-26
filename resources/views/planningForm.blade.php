@extends('master')

@section('title', 'Créer une séance de cours')

@section('content')
    <h3>Création d'une séance de cours</h3>
    @if(Auth::user()->type == 'admin' || Auth::user()->type == 'enseignant')
        <form action="{{route('planning.store')}}" method="post">
            Cours :<br>
            @foreach($cours as $cour)
                <input type="radio" id="c{{$cour->id}}" name="cours_id" value="{{$cour->id}}">
                <label for="c{{$cour->id}}">{{$cour->intitule}}</label><br>
            @endforeach
            Date de début: <input type="datetime-local" name="date_debut" value="{{old('date_debut')}}"><br>
            Date de fin: <input type="datetime-local" name="date_fin" value="{{old('date_fin')}}"><br>
            <input type="submit" value="Créer la séance de cours">
            @csrf
        </form>
    @endif
@endsection