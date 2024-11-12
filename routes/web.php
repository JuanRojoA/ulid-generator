<?php

use App\Http\Controllers\UlidController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UlidController::class, 'index'])->name('ulid.index');
Route::post('/generate', [UlidController::class, 'generate'])->name('ulid.generate');
