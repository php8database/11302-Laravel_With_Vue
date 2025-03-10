<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\EventController;

Route::get('/', [EventController::class,'index'])->name('home');
Route::post('/store', [EventController::class,'store'])->name('store');
Route::post('/update/{id}', [EventController::class,'update'])->name('update');
Route::post('/{id}', [EventController::class,'destroy'])->name('destroy');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
