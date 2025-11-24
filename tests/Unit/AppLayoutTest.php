<?php

use App\View\Components\AppLayout;
use App\Models\User;
use Illuminate\Support\Facades\Blade;

it('renders the navigation component', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $view = view('layouts.navigation')->render();
    expect($view)->toContain('Tableau de bord');
    expect($view)->toContain($user->name);
});

it('renders the app layout component with slot content', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $content = 'Main Content Area';
    $view = Blade::render('<x-app-layout>'.$content.'</x-app-layout>');

    expect($view)->toContain($content);
    expect($view)->toContain('<!DOCTYPE html>');
});

it('renders the app layout view with a header', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $header = 'My Custom Header';
    $view = view('layouts.app', [
        'header' => $header,
        'slot' => 'Body'
    ])->render();

    expect($view)->toContain($header);
    expect($view)->toContain('Body');
});

it('app layout component class renders the correct view', function () {
    $component = new AppLayout();
    $view = $component->render();

    expect($view->name())->toBe('layouts.app');
});
