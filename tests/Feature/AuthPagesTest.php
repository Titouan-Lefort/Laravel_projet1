<?php

it('register page has expected fields', function () {
    $resp = $this->get('/register');
    $resp->assertStatus(200);
    $resp->assertSee('name="name"', false);
    $resp->assertSee('name="email"', false);
    $resp->assertSee('name="password"', false);
});

it('login page has expected fields', function () {
    $resp = $this->get('/login');
    $resp->assertStatus(200);
    $resp->assertSee('name="email"', false);
    $resp->assertSee('name="password"', false);
});

it('password reset page has email field (if present)', function () {
    $resp = $this->get('/password/reset');

    if ($resp->getStatusCode() === 200) {
        $resp->assertSee('name="email"', false);
    } else {
        // Some apps do not expose a password reset page by default
        $resp->assertStatus(404);
    }
});
