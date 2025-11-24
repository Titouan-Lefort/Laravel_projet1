<?php

use App\Models\Favorite;
use App\Models\Univers;
use App\Models\User;

it('adds and removes a favorite via the toggle endpoint', function () {
    // Create user and univers
    $user = User::factory()->create();
    $univers = Univers::factory()->create();

    // Act as user
    $this->actingAs($user);

    // Add favorite
    $response = $this->postJson(route('favorites.toggle'), ['univers_id' => $univers->id]);
    $response->assertStatus(200)->assertJson(['status' => 'added']);

    $this->assertDatabaseHas('favorites', [
        'user_id' => $user->id,
        'univers_id' => $univers->id,
    ]);

    // Toggle again to remove
    $response = $this->postJson(route('favorites.toggle'), ['univers_id' => $univers->id]);
    $response->assertStatus(200)->assertJson(['status' => 'removed']);

    $this->assertDatabaseMissing('favorites', [
        'user_id' => $user->id,
        'univers_id' => $univers->id,
    ]);
});
