@extends('layouts.header')

@section('name')
connection
@endsection
@section('content')
<form action="{{ route('user.store') }}" method="post"  enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Nom" class="border border-solid p-2 border-black rounded-lg m-4">
    <br>
    <input type="textarea" name="description" placeholder="Description" class="border border-solid p-2 border-black rounded-lg m-4">
    <p class="text-white bg-black p-2 ">Image</p>
    <input type="file" name="image">
    <p class="text-white bg-black p-2">logo</p>
    <input type="file" name="logo">
    <p>couleur principale</p>
    <input type="color" name="couleur_principale" placeholder="Couleur principale">
    <p>couleur secondaire</p>
    <input type="color" name="couleur_secondaire" placeholder="Couleur secondaire">
    <input type="submit" value="S'inscrire" class="p-4 bg-black text-white">
</form>
@endsection
