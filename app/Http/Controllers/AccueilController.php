<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;

class AccueilController extends Controller
{
 public function __construct(public ?string $message = null) {
    $this->message = $message ?? 'hello';
}


    public function page(?string $message = null){
        return Str::ucfirst($message ?? $this->message);
        }
    }
