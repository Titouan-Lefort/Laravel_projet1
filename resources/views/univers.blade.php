
@extends('layouts.header')

@section("name")
    {{ __('Universes') }}
@endsection

@section("content")
    <div class="min-h-screen bg-gradient-to-br from-slate-50 to-gray-100">
        <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-12 text-center">
                <h1 class="mb-4 text-4xl font-bold text-gray-900">{{ __('Discover Universes') }}</h1>
                <p class="max-w-2xl mx-auto text-lg text-gray-600">{{ __('Explore amazing universes created by our community') }}</p>
            </div>

            <!-- Grid des cartes -->
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @forelse ($liste as $univers)
                    <div class="overflow-hidden transition-all duration-500 bg-white border border-gray-100 shadow-lg group rounded-3xl hover:shadow-2xl hover:-translate-y-2">
                        <!-- Section Image -->
                        <div class="relative p-6 bg-gradient-to-br from-gray-50 to-gray-100">
                            <!-- Image principale avec logo superposé -->
                            <div class="relative mb-4 overflow-hidden bg-white border-2 border-white shadow-md aspect-square rounded-2xl">
                                @if($univers->image)
                                    <img src="{{ asset($univers->image) }}" alt="{{ $univers->name }}" class="object-cover w-full h-full transition-transform duration-500 group-hover:scale-105">
                                @else
                                    <div class="flex items-center justify-center w-full h-full text-6xl font-light text-gray-300 bg-gradient-to-br from-gray-100 to-gray-200">?</div>
                                @endif

                                <!-- Logo mini superposé en bas à droite -->
                                @if($univers->logo)
                                    <div class="absolute flex items-center justify-center w-10 h-10 p-1 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg bottom-2 right-2">
                                        <img src="{{ asset($univers->logo) }}" alt="Logo" class="object-contain w-full h-full">
                                    </div>
                                @endif
                            </div>

                            <!-- Bouton favoris centré -->
                            @if (Auth::check())
                                <div class="flex justify-center">
                                    <button class="p-3 transition-all duration-300 border rounded-full shadow-lg bg-white/90 backdrop-blur-sm hover:shadow-xl hover:scale-110 border-white/50 favorite-btn" data-id="{{ $univers->id }}">
                                        <img src="{{ asset($univers->favoritedBy->contains(Auth::id()) ? 'icons/starcolor.png' : 'icons/star.png') }}" class="w-5 h-5 favorite-icon" alt="{{ __('Favorite') }}">
                                    </button>
                                </div>
                            @endif
                        </div>

                        <!-- Contenu -->
                        <div class="px-6 pb-6">
                            <h3 class="mb-2 text-xl font-bold text-gray-900 transition-colors line-clamp-1 group-hover:text-indigo-600">{{ $univers->name }}</h3>
                            <div class="w-full h-32 pr-2 mb-4 overflow-y-auto text-sm leading-relaxed text-gray-600 scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                                {{ $univers->description }}
                            </div>

                            <!-- Couleurs -->
                            <div class="flex items-center justify-center gap-4 mb-6">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-semibold tracking-wider text-gray-500 uppercase">{{ __('Primary') }}</span>
                                    <div class="w-4 h-4 rounded-full"
                                         style="background-color: {{ $univers->couleur_principale ?? '#d1d5db' }};"
                                         title="{{ $univers->couleur_principale }}"></div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-semibold tracking-wider text-gray-500 uppercase">{{ __('Secondary') }}</span>
                                    <div class="w-4 h-4 rounded-full"
                                         style="background-color: {{ $univers->couleur_secondaire ?? '#d1d5db' }};"
                                         title="{{ $univers->couleur_secondaire }}"></div>
                                </div>
                            </div>

                            <!-- Actions -->
                            @if (Auth::check() && (Auth::user()->can('modif-univers') || Auth::user()->can('supp-univers')))
                                <div class="flex items-center justify-center gap-3 pt-4 border-t border-gray-100">
                                    @can('modif-univers')
                                        <a href="{{ route('user.edit', $univers->id) }}" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-indigo-600 transition-all duration-300 border border-indigo-200 bg-indigo-50 rounded-xl hover:bg-indigo-100 hover:shadow-md">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            {{ __("Edit") }}
                                        </a>
                                    @endcan

                                    @can('supp-univers')
                                        <form action="{{ route('user.destroy', $univers->id) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 transition-all duration-300 border border-red-200 bg-red-50 rounded-xl hover:bg-red-100 hover:shadow-md">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                {{ __("Delete") }}
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-20 text-center col-span-full">
                        <div class="flex items-center justify-center w-32 h-32 mb-8 rounded-full shadow-lg bg-gradient-to-br from-gray-100 to-gray-200">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <h3 class="mb-3 text-2xl font-semibold text-gray-900">{{ __('No universe exists') }}</h3>
                        <p class="max-w-md mb-8 text-gray-600">{{ __('Get started by creating your first amazing universe and share it with the community.') }}</p>
                        @if(Auth::check() && Auth::user()->can('create-univers'))
                            <a href="{{ route('user.create') }}" class="inline-flex items-center gap-2 px-6 py-3 font-medium text-white transition-all duration-300 transform shadow-lg bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl hover:from-indigo-700 hover:to-purple-700 hover:shadow-xl hover:-translate-y-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Create Universe') }}
                            </a>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.favorite-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const universId = this.dataset.id;
                const imgEl = this.querySelector('.favorite-icon');

                // Disable button during request
                this.disabled = true;
                this.classList.add('opacity-50');

                fetch("{{ route('favorites.toggle') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ univers_id: universId })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'added') {
                        imgEl.src = "{{ asset('icons/starcolor.png') }}";
                    } else {
                        imgEl.src = "{{ asset('icons/star.png') }}";
                    }
                })
                .catch(err => console.error(err))
                .finally(() => {
                    this.disabled = false;
                    this.classList.remove('opacity-50');
                });
            });
        });
    </script>
@endsection
