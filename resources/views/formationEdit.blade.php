@extends('master')

@section('title', 'Modifier une formation')

@section('content')
    <form action="{{route('formation.update', $formation->id)}}" method="post">
        @method('put')
        Intitulé: <input type="text" name="intitule" value="{{$formation->intitule}}">
        <input type="submit" value="Modifier">
        @csrf
    </form>


    <form action="{{route('formation.destroy', $formation->id)}}" method="post">
        @method('delete')
        <input type="submit" value="Supprimer">
        @csrf
    </form>
@endsection