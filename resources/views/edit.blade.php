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
            <x-input-text name="name" place="{{ __('Name') }}" value="{{ $univers->name ?? ''}}"/>
            <br>
            <textarea name="description" placeholder="Description" class="p-2 m-4 border border-black border-solid rounded-lg">{{ $univers->description ?? '' }}</textarea>
            <p class="p-2 text-white bg-black ">{{ __('Image') }}</p>
            <input type="file" name="image">
            @if($univers)
                <x-img src="{{ asset('storage/'.$univers->image) }}"/>
            @endif
            <p class="p-2 text-white bg-black">{{ __('Logo') }}</p>
            <input type="file" name="logo">
            @if($univers)
                <x-img src="{{ asset('storage/'.$univers->logo) }}"/>
            @endif
            <p>{{ __('Principal color') }}</p>
            <x-input-color name="couleur_principale" value="{{ $univers->couleur_principale ?? ''}}"/>
            <p>{{ __('Secondary color') }}</p>
            <x-input-color name="couleur_secondaire" value="{{ $univers->couleur_secondaire ?? ''}}"/>

            <input type="submit" value="{{ $univers ? __('Edit') : __('Create') }}" class="p-4 text-white bg-black">

        </form>
    @endsection
