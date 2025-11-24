<?php

use App\Models\User;
use App\Models\Univers;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

it('user has expected casts and favorites relation declared', function () {
    $user = new User();

    $casts = $user->getCasts();
    expect($casts['email_verified_at'])->toBe('datetime');
    expect($casts['password'])->toBe('hashed');

    // Ensure favorites method exists and references belongsToMany in source
    $this->assertTrue(method_exists(User::class, 'favorites'));
    $ref = new ReflectionMethod(User::class, 'favorites');
    $src = implode('', array_slice(file($ref->getFileName()), $ref->getStartLine() - 1, $ref->getEndLine() - $ref->getStartLine() + 1));
    expect(strpos($src, 'belongsToMany') !== false)->toBeTrue();
});

it('univers favoritedBy relation declared', function () {
    $this->assertTrue(method_exists(Univers::class, 'favoritedBy'));
    $ref = new ReflectionMethod(Univers::class, 'favoritedBy');
    $src = implode('', array_slice(file($ref->getFileName()), $ref->getStartLine() - 1, $ref->getEndLine() - $ref->getStartLine() + 1));
    expect(strpos($src, 'belongsToMany') !== false)->toBeTrue();
});
