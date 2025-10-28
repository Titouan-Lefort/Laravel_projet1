<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\InfoMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
        public function sendMail()
    {
        $user = (object) ['name' => 'Jean Dupont', 'email' => 'jean@example.com'];

        Mail::to($user->email)->send(new InfoMail($user));

        return "Mail envoyé à Mailtrap avec succès ";
    }
}
