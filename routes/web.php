<?php

use App\Http\Controllers\PageController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

// Redirect root to default locale
Route::redirect('/', '/en');

// Language switch
Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'sw'])) {
        session(['locale' => $locale]);
    }
    $path = url()->previous();
    // Replace locale segment in previous URL
    $path = preg_replace('#/(en|sw)(/|$)#', "/{$locale}$2", $path);
    return redirect($path ?: "/{$locale}");
})->name('lang.switch');

// Localized routes
Route::prefix('{locale}')
    ->where(['locale' => 'en|sw'])
    ->middleware(SetLocale::class)
    ->group(function () {

        Route::get('/', [PageController::class, 'home'])->name('home');
        Route::get('/about', [PageController::class, 'about'])->name('about');
        Route::get('/sermons', [PageController::class, 'sermons'])->name('sermons');
        Route::get('/radio', [PageController::class, 'radio'])->name('radio');
        Route::get('/events', [PageController::class, 'events'])->name('events');
        Route::get('/ministries', [PageController::class, 'ministries'])->name('ministries');
        Route::get('/foundation', [PageController::class, 'foundation'])->name('foundation');
        Route::get('/give', [PageController::class, 'give'])->name('give');
        Route::get('/prayer', [PageController::class, 'prayer'])->name('prayer');
        Route::post('/prayer', [PageController::class, 'prayerStore'])->name('prayer.store');
        Route::get('/contact', [PageController::class, 'contact'])->name('contact');

    });
