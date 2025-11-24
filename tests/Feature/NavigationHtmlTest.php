<?php

use App\Models\User;

it('shows the authenticated user name in the navigation', function () {
    $user = User::factory()->create(['name' => 'NavUser']);

    $this->actingAs($user);

    $resp = $this->get('/');
    $resp->assertStatus(200);

    $resp->assertSee('NavUser');
});
