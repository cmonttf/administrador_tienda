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
    Route::get("/", function () {
        return abort(403, "No tiene permiso");
    });
    Route::resource('productos', ProductoController::class);
});
