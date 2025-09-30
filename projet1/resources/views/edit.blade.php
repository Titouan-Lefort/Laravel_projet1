@extends('layouts.header')

@section('name')
connection
@endsection
@section('content')
    <form action="{{$univers ? route('user.update', $univers->id) : route('user.store')}}" method="post"  enctype="multipart/form-data">
        @csrf
        @if($univers)
            @method('PUT')
        @endif
        <x-input-text name="name" place="Nom" value="{{ $univers->name ?? ''}}"/>
        <br>
        <textarea name="description" placeholder="Description" class="border border-solid p-2 border-black rounded-lg m-4">{{ $univers->description ?? '' }}</textarea>
        <p class="text-white bg-black p-2 ">Image</p>
        <input type="file" name="image">
        @if($univers)
            <x-img src="{{ asset('storage/'.$univers->image) }}"/>
        @endif
        <p class="text-white bg-black p-2">logo</p>
        <input type="file" name="logo">
        @if($univers)
            <x-img src="{{ asset('storage/'.$univers->logo) }}"/>
        @endif
        <p>couleur principale</p>
        <x-input-color name="couleur_principale" value="{{ $univers->couleur_principale ?? ''}}"/>
        <p>couleur secondaire</p>
        <x-input-color name="couleur_secondaire" value="{{ $univers->couleur_secondaire ?? ''}}"/>

        <input type="submit" value="{{ $univers ? 'Modifier' : 'Créer' }}" class="p-4 bg-black text-white">

    </form>
@endsection
