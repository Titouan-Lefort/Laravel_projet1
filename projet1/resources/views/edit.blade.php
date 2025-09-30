@extends('layouts.header')

@section('name')
connection
@endsection
@section('content')
<form action="{{ route('user.update', $univers->id) }}" method="post"  enctype="multipart/form-data">
    @csrf
    @method('put')
    <input type="text" name="name" placeholder="Nom" value="{{ $univers->name }}" class="border border-solid p-2 border-black rounded-lg m-4">
    <br>
    <input type="textarea" name="description" placeholder="Description" value="{{ $univers->description }}" class="border border-solid p-2 border-black rounded-lg m-4">
    <p class="text-white bg-black p-2 ">Image</p>
    <input type="file" name="image">
    <img src="{{ asset('storage/'.$univers->image) }}" alt="" class="w-30 h-30 object-cover m-4    ">
    <p class="text-white bg-black p-2">logo</p>
    <input type="file" name="logo" value="{{ $univers->logo }}">
    <img src="{{ asset('storage/'.$univers->logo) }}" alt="" class="w-30 h-30 object-cover m-4 ">
    <p>couleur principale</p>
    <input type="color" name="couleur_principale" placeholder="Couleur principale" value="{{ $univers->couleur_principale }}">
    <p>couleur secondaire</p>
    <input type="color" name="couleur_secondaire" placeholder="couleur secondaire" value="{{ $univers->couleur_secondaire }}">
    <input type="submit" value="Modifier" class="p-4 bg-black text-white">
</form>
@endsection
