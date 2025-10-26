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
            <textarea name="description" placeholder="Description" class="p-2 m-4 border border-black border-solid rounded-lg">{{ $univers->description ?? '' }}</textarea>
            <p class="p-2 text-white bg-black ">Image</p>
            <input type="file" name="image">
            @if($univers)
                <x-img src="{{ asset('storage/'.$univers->image) }}"/>
            @endif
            <p class="p-2 text-white bg-black">logo</p>
            <input type="file" name="logo">
            @if($univers)
                <x-img src="{{ asset('storage/'.$univers->logo) }}"/>
            @endif
            <p>couleur principale</p>
            <x-input-color name="couleur_principale" value="{{ $univers->couleur_principale ?? ''}}"/>
            <p>couleur secondaire</p>
            <x-input-color name="couleur_secondaire" value="{{ $univers->couleur_secondaire ?? ''}}"/>

            <input type="submit" value="{{ $univers ? 'Modifier' : 'Créer' }}" class="p-4 text-white bg-black">

        </form>
    @endsection
