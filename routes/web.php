<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TtsController; 

// Formulario
Route::get('/', [TtsController::class, 'index'])->name('tts.index');

// Retorno do Audio
Route::post('/speak', [TtsController::class, 'speak'])->name('tts.speak');