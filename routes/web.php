<?php

use App\Http\Controllers\OrdersController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SamplesController;
use App\Http\Controllers\ClientsController;
use Illuminate\Support\Facades\Route;

Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/nosotros', 'us');
    Route::get('/contacto', 'contact');
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'auth');
    Route::get('/testing-eloquent', 'testingEloquent');
    Route::get('/filters', 'filters');
    Route::get('/logout', 'logout');
});

Route::middleware('auth')->group(function () {
    Route::prefix('/orders')->group(function () {
        Route::get('/', [OrdersController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrdersController::class, 'create'])->name('orders.create');
        Route::get('/show/{id}', [OrdersController::class, 'show'])->name('orders.show');
        Route::get('/edit/{id}', [OrdersController::class, 'edit'])->name('orders.edit');
        Route::get('/change-page', [OrdersController::class, 'changePage']);
        Route::get('/get-client-for-order', [OrdersController::class, 'getClientForOrder']);
        /*Route::get('/test', [TestController::class, 'test']);
        Route::get('/test-dynamic-form', [TestController::class, 'viewTestDynamicForm']);
        Route::get('/testing', [TestController::class, 'viewTestingForm']);
        Route::post('/test-dynamic-form', [TestController::class, 'testDynamicForm']);*/
        Route::post('/', [OrdersController::class, 'store'])->name('orders.store');
        Route::put('/{id}', [OrdersController::class, 'update'])->name('orders.update');
        Route::delete('/{id}', [OrdersController::class, 'delete'])->name('orders.delete');
        Route::patch('/editPartialInfo/{id}', [OrdersController::class, 'editPartialInfo'])->name('orders.partialEdit');
        Route::post('/toggle-cesavedac', [OrdersController::class, 'toggleCesavedac']);
        Route::post('/toggle-supervision', [OrdersController::class, 'toggleSupervision']);
        Route::post('/toggle-hoja-campo', [OrdersController::class, 'toggleHojaCampo']);
        Route::post('/toggle-cadena-custodia', [OrdersController::class, 'toggleCadenaCustodia']);
        Route::post('/toggle-croquis', [OrdersController::class, 'toggleCroquis']);
        Route::post('/toggle-reporte-entregado', [OrdersController::class, 'toggleReporteEntregado']);
        Route::post('/filter', [OrdersController::class, 'filter']);
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('/samples')->group(function () {
        Route::get('/create-water/{folio}/{numero_muestras}/{inicio_muestras}', [SamplesController::class, 'createWater'])->name('samples.create_water');
    });
});

Route::middleware('auth')->group(function () {
    Route::prefix('/clients')->group(function () {
        Route::get('/clients_by_name', [ClientsController::class, 'clientsByName']);
    });
});
