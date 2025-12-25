<?php

use App\Http\Controllers\Admin\GeminiController;
use Illuminate\Support\Facades\Route;

Route::post('/ai/ask', [GeminiController::class, 'ask']);
