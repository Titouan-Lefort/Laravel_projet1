<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UniversController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'lang'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('user', UniversController::class)->middleware('lang');

Route::get('/', [UniversController::class, 'index'])->middleware('lang');

Route::get('/lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'fr'])) {
        abort(400, 'Langue non supportée');
    }
    Session::put('locale', $locale);

    return redirect()->back();
    app::setLocale($locale);
})->name('lang');

Route::get('/send-mail', [App\Http\Controllers\MailController::class, 'sendMail']);

Route::post('/favorites/toggle', [FavoriteController::class, 'toggle'])
    ->name('favorites.toggle')
    ->middleware('auth');

require __DIR__.'/auth.php';
