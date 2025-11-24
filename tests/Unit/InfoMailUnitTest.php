<?php

use App\Mail\InfoMail;
use App\Models\Univers;
use App\Models\User;

it('builds the InfoMail with correct envelope and view data', function () {
    $user = User::factory()->make();
    $univers = Univers::factory()->make();

    $mail = new InfoMail($user, $univers);

    // Envelope subject
    $envelope = $mail->envelope();
    expect($envelope->subject)->toBe('Info Mail');

    // Content (view) and data
    $content = $mail->content();
    expect($content->view)->toBe('emails.test');

    // Render the mailable view to ensure it doesn't throw and contains expected fragments
    $rendered = $mail->render();
    expect(strpos($rendered, (string) $univers->name) !== false)->toBeTrue();
});
