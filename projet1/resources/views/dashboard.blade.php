@extends('layouts.header')
@section('content')
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-black shadow-sm black sm:rounded-lg">
                <div class="p-6 white dark:text-gray-100">
                    {{ __("Vous êtes connecté !") }}
                </div>
            </div>
        </div>
    </div>
@endsection
