<?php

use App\Models\URL;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('url', App\Http\Controllers\URLController::class);
    Route::get('url/{code}', [App\Http\Controllers\URLController::class, 'show']);
});

Route::get('{any?}', function ($any = null) {
    if (Cache::has('sh-' . $any)) {
        return redirect(Cache::get('sh-' . $any));
    }

    $url = URL::where('code', $any)->first();
    if ($url) {
        return redirect($url->url);
    } else {
        return redirect('/');
    }
})->where('any', '.*');
