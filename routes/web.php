<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/proyectos/create', [ProyectoController::class, 'create'])->name('proyectos.create');
Route::get('/proyectos', [ProyectoController::class, 'index'])->name('proyectos.index');
Route::post('/proyectos', [ProyectoController::class, 'store'])->name('proyectos.store');
Route::get('/proyectos/{id}', [ProyectoController::class, 'show'])->name('proyectos.show'); 
Route::put('/proyectos/{id}', [ProyectoController::class, 'update'])->name('proyectos.update'); 
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy'])->name('proyectos.destroy');
Route::get('/proyectos/{id}/edit', [ProyectoController::class, 'edit'])->name('proyectos.edit');
Route::get('/panel', [ProyectoController::class, 'panel'])->name('proyectos.panel');
// Route::get('/proyectos/buscar', [ProyectoController::class, 'buscar'])->name('proyectos.buscar');
