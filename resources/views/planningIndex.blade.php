@extends('master')

@section('title', 'Modifier un planning')

@section('content')
    Cours: {{$planning->cours->intitule}}
    <form action="{{route('planning.update', $planning->id)}}" method="post">
        @method('put')
        @foreach($cours as $cour)
                <input type="radio" id="c{{$cour->id}}" name="cours_id" value="{{$cour->id}}" {{ $cour->id == $planning->cours_id ? "checked" : null }}>
                <label for="c{{$cour->id}}">{{$cour->intitule}}</label><br>
        @endforeach
        Date de début: <input type="datetime-local" name="date_debut" value="{{$planning->date_debut}}">
        Date de fin: <input type="datetime-local" name="date_fin" value="{{$planning->date_fin}}">
        <input type="submit" value="Modifier">
        @csrf
    </form>


    <form action="{{route('planning.destroy', $planning->id)}}" method="post">
        @method('delete')
        <input type="submit" value="Supprimer">
        @csrf
    </form>
@endsection