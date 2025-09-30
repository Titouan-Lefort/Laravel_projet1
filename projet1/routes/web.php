<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversController;
use App\Http\Controllers\UserController;


// Route::get('{a}/{b?}', function (string $a, string $b = 'ok'){
//     return "je suis sur la page $b depuis la page $a";
// })->where(['a' => '[a-zA-Z]+']);

Route::resource('user', UniversController::class);

Route::get('/', [UniversController::class, 'index']);

// Route::post('{id}/edit', [UniversController::class, 'edit']);
// Route::post('user/{id}', [UniversController::class, 'update']);


