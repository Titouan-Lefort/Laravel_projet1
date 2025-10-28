
@extends('layouts.header')
@section("name")
univers
@endsection
@section("content")
<table class="w-full p-4 text-center border-collapse table-auto">
    <tr class="border border-gray-300">
        <th class="py-4">{{__('Name')}}</th>
        <th>{{ __('Description') }}</th>
        <th>{{ __('Image') }}</th>
        <th>{{ __('Logo') }}</th>
        <th>{{ __('Principal color') }}</th>
        <th>{{ __('Secondary color') }}</th>
        @if (Auth::check())
            @can('supp-univers' ?? 'modif-univers')
                <th>{{ __('Actions') }}</th>
            @endcan
        @endif
    </tr>
    @forelse ($liste as $univers)
    <tr class="m-4 border border-black">
        <td>{{ $univers->name }}</td>
        <td>{{ $univers->description}}</td>
        <td  class="py-4"><img src="{{ $univers->image }}" class="object-cover w-20 h-20 mx-auto"></td>
        <td><img src="{{ $univers->logo }}" class="object-cover w-20 h-20 mx-auto"></td>
        <td><div class="w-20 p-4 m-auto border border-black border-solid rounded-lg" style="background-color: {{ $univers->couleur_principale }}"></div></td>
        <td><div class="w-20 p-4 m-auto border border-black border-solid rounded-lg" style="background-color: {{ $univers->couleur_secondaire }}"></div></td>
        @if (Auth::check())
        @can('modif-univers')
            <td><a class="px-4 py-2 transition-colors duration-300 bg-green-500 border border-black rounded-lg hover:bg-green-300" href="{{ route('user.edit', $univers->id) }}">Modifier</a>
        @endcan
        @can('supp-univers')
            <form action="{{ route('user.destroy', $univers->id) }}" method="POST"> @csrf @method('DELETE') <input type="submit" class="px-4 py-2 m-3 transition-colors duration-300 bg-red-500 border border-black rounded-lg hover:bg-red-300" value="Supprimer"></form>
        @endcan
        @endif
    @empty
        <td class="my-4 text-xl">{{ __('No universe exists') }}</td>
    </tr>
     @endforelse
</table>
@endsection
