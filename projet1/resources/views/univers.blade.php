
@extends('layouts.header')
@section("name")
univers
@endsection
@section("content")
<table class="table-auto border-collapse w-full text-center p-4">
    <tr class="border border-gray-300">
        <th class="py-4">Nom</th>
        <th>Description</th>
        <th>Image</th>
        <th>Logo</th>
        <th>Couleur principale</th>
        <th>Couleur secondaire</th>
        <th>Actions</th>
    </tr>
    @forelse ($liste as $univers)
    <tr class="border border-black m-4">
        <td>{{ $univers->name }}</td>
        <td>{{ $univers->description}}</td>
        <td  class="py-4"><img src="{{ $univers->image }}" class="w-20 h-20 object-cover mx-auto"></td>
        <td><img src="{{ $univers->logo }}" class="w-20 h-20 object-cover mx-auto"></td>
        <td><div class="border border-solid border-black p-4 rounded-lg w-50 m-auto" style="background-color: {{ $univers->couleur_principale }}"></div></td>
        <td><div class="border border-solid border-black p-4 rounded-lg w-50 m-auto" style="background-color: {{ $univers->couleur_secondaire }}"></div></td>
        <td><a class="py-2 px-4 bg-green-500 rounded-lg border border-black hover:bg-green-300 transition-colors duration-300" href="{{ route('user.edit', $univers->id) }}">Modifier</a>
        <form action="{{ route('user.destroy', $univers->id) }}" method="POST"> @csrf @method('DELETE') <input type="submit" class="py-2 px-4 bg-red-500 rounded-lg border border-black m-3 hover:bg-red-300 transition-colors duration-300" value="Supprimer"></form>

    @empty
        <td class="text-xl my-4">Aucun univers existes</td>
    </tr>
     @endforelse
</table>
@endsection
