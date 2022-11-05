<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;


## EVENTOS #####

Route::get('/calendario',[EventoController::class, 'index'])->name('calendario');
Route::get('/calendario/mostrar',[EventoController::class, 'show'])->name('mostrar');
Route::post('/calendario/agregar',[EventoController::class, 'store'])->name('agregar');
Route::post('/calendario/editar/{id}',[EventoController::class, 'edit'])->name('editar');





Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



