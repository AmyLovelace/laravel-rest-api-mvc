<?php

use App\Http\Controllers\ProyectoController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/proyecto', [ProyectoController::class, 'showAll']);
Route::post('/proyecto', [ProyectoController::class, 'store']);
Route::get('/proyecto/{id}', [ProyectoController::class, 'show']);
Route::put('/proyecto/{id}', [ProyectoController::class, 'update']);
Route::delete('/proyecto/{id}', [ProyectoController::class, 'destroy']);
Route::get('/proyectos/buscar', [ProyectoController::class, 'buscar'])->name('proyectos.buscar');

Route::get('/test', function () {
    return response()->json(['ok' => true]);
});