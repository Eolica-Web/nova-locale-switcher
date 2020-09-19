<?php

use Illuminate\Support\Facades\Route;
use Eolica\NovaLocaleSwitcher\Http\Controllers\GetLocalesController;
use Eolica\NovaLocaleSwitcher\Http\Controllers\SwitchLocaleController;

Route::get('/locales', GetLocalesController::class);

Route::post('/switch-locale', SwitchLocaleController::class);
