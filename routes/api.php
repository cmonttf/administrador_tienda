<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("/", function () {
    return redirect("/v1");
});

Route::prefix('v1')->group(function () {
    Route::get('/', function () {
        return view('admin.mantencion'); // o redirect('/v1/admin/dashboard')
    })->name('admin.mantencion');

    //Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // crea luego esta vista
    })->name('admin.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/productos', [ProductoController::class, 'index'])->name('products.index');
        Route::get('/productos/create', [ProductoController::class, 'create'])->name('products.create');
        Route::post('/productos', [ProductoController::class, 'store'])->name('products.store');
        Route::get('/productos/show/{id}', [ProductoController::class, 'show'])->name('products.show');
        Route::get('/productos/edit/{id}', [ProductoController::class, 'edit'])->name('products.edit');
        Route::post('/productos/{id}', [ProductoController::class, 'update'])->name('products.update');
        Route::delete('/productos/destroy/{id}', [ProductoController::class, 'destroy'])->name('products.destroy');
    });
});
