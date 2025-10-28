@props([
    'value',
    'name',
    'place',
])
<input type="text" value="{{ $value }}" name="{{ $name }}" placeholder="{{ $place }}" class="border border-solid p-2 border-black rounded-lg m-4" id="text">
<label for="text">nom</label>

