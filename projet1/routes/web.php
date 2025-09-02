<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('{a}/{b?}', function (string $a, string $b = 'ok'){
//     return "je suis sur la page $b depuis la page $a";
// })->where(['a' => '[a-zA-Z]+']);

Route::get('page/{message?}', [AccueilController::class, 'page']);

Route::resource('TestController', TestController::class);
