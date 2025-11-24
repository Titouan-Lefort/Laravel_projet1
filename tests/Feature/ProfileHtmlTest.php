<?php

use App\Models\User;

it('profile edit page contains name and email inputs', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $resp = $this->get('/profile');
    $resp->assertStatus(200);

    // Ensure the form inputs are present
    $resp->assertSee('name="name"', false);
    $resp->assertSee('name="email"', false);
});
