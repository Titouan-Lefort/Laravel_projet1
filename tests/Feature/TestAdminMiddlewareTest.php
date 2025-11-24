<?php

use App\Http\Middleware\TestAdmin;
use App\Models\User;
use Illuminate\Support\Facades\Route;

it('blocks guests and non-admin users and allows admin users', function () {
    // Register a temporary route with the middleware
    Route::middleware(TestAdmin::class)->get('/__test-admin', function () {
        return response('ok');
    });

    // Guest should be forbidden
    $this->get('/__test-admin')->assertStatus(403);

    // Non-admin user
    $user = User::factory()->create(['status' => 'user']);
    $this->actingAs($user);
    $this->get('/__test-admin')->assertStatus(403);

    // Admin user
    $admin = User::factory()->create(['status' => 'admin']);
    $this->actingAs($admin);
    $this->get('/__test-admin')->assertStatus(200)->assertSeeText('ok');
});
