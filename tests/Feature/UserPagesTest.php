<?php

use App\Models\Univers;

it('user create page contains form inputs', function () {
    $user = \App\Models\User::factory()->create();
    $this->actingAs($user);

    $resp = $this->get('/user/create');
    $resp->assertStatus(200);
    $resp->assertSee('<input', false);
});

it('user edit page contains form inputs', function () {
    $univers = Univers::factory()->create();

    $resp = $this->get("/user/{$univers->id}/edit");
    $resp->assertStatus(200);
    $resp->assertSee('<input', false);
});
