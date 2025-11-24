<?php

use App\Models\User;
use App\Models\Univers;
use App\Models\Favorite;

it('can attach and retrieve favorites via pivot', function () {
    $user = User::factory()->create();
    $univers = Univers::factory()->create();

    // Use the Favorite pivot model to create an entry
    Favorite::create(['user_id' => $user->id, 'univers_id' => $univers->id]);

    $this->assertTrue($univers->favoritedBy->contains($user->id));
    $this->assertTrue($user->favorites->contains($univers->id));
});
