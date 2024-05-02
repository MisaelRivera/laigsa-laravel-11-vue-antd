<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/nosotros', 'us');
    Route::get('/contacto', 'contact');
    Route::get('/login', 'login');
});