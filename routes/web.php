<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/nosotros', 'us');
    Route::get('/contacto', 'contact');
    Route::get('/login', 'login');
    Route::post('/login', 'auth');
    Route::get('/testing-eloquent', 'testingEloquent');
    Route::get('/filters', 'filters');
});

Route::controller(OrdersController::class)->group(function () {
    Route::get('/orders', 'index')->name('orders.index');
});
