@extends('master')

@section('title', 'Ajouter une formation')

@section('content')
    <h3>Ajouter une formation</h3>
    <form action="{{route('formation.store')}}" method="post">
        Intitulé: <input type="text" name="intitule" value="{{old('intitule')}}">
        <input type="submit" value="Envoyer">
        @csrf
    </form>
@endsection