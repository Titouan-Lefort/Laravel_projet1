<?php

use App\Models\Univers;
use App\Models\User;

it('shows univers list with favorites column when authenticated', function () {
    $user = User::factory()->create();
    $univers = Univers::factory()->create(['name' => 'MyUniverse']);

    $this->actingAs($user);

    $resp = $this->get('/');
    $resp->assertStatus(200);

    // The created univers should be listed and table headers exist
    $resp->assertSee('Nom');
    $resp->assertSee('Description');

    // Authenticated users should see 'Favoris' header
    $resp->assertSee('Favoris');

    // The created univers should be listed
    $resp->assertSee('MyUniverse');

    // Image element from the univers row should be present (check the class used)
    $resp->assertSee('object-cover w-20 h-20 mx-auto');
});

it('hides favorites column for guests', function () {
    $univers = Univers::factory()->create(['name' => 'GuestUniverse']);

    $resp = $this->get('/');
    $resp->assertStatus(200);

    $resp->assertSee('Nom');
    $resp->assertDontSee('Favoris');
    $resp->assertSee('GuestUniverse');
});
