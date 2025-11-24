<?php

use App\Models\User;

it('has the expected casts on the User model', function () {
    $user = new User();

    $casts = $user->getCasts();

    expect(array_key_exists('email_verified_at', $casts))->toBeTrue();
    expect($casts['email_verified_at'])->toBe('datetime');

    // password should be hashed via the 'hashed' cast in Laravel 11+
    expect(array_key_exists('password', $casts))->toBeTrue();
    expect($casts['password'])->toBe('hashed');
});
