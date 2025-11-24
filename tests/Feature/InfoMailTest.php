<?php

use App\Mail\InfoMail;
use App\Models\Univers;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it('sends InfoMail with expected univers data', function () {
    Mail::fake();

    $user = User::factory()->create();
    $univers = Univers::factory()->create();

    Mail::to($user->email)->send(new InfoMail($user, $univers));

    Mail::assertSent(InfoMail::class, function ($mail) use ($univers) {
        return $mail->univers !== null && $mail->univers->id === $univers->id;
    });
});
