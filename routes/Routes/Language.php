<?php

use App\Http\Controllers\Language\LanguageController;
use Illuminate\Support\Facades\Route;

Route::apiResource('languages', LanguageController::class)->except(['destroy', 'create']);
