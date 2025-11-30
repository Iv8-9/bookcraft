<?php

use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ClasificacionController;
use App\Http\Controllers\EstatusController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\ProgresoController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\UsuarioController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CorsMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('login',[LoginController::class, 'login']);

Route::post('clasificacion/new', [ClasificacionController::class, 'store'])->name('clasificacion/new');
Route::post('clasificaciones', [ClasificacionController::class, 'index'])->name('clasificaciones');
Route::post('clasificacion', [ClasificacionController::class, 'show'])->name('clasificacion');
Route::post('clasificacion/update', [ClasificacionController::class, 'store'])->name('clasificacion/update');
Route::post('clasificacion/delete', [ClasificacionController::class, 'destroy'])->name('clasificacion/delete');

Route::post('estatus/new', [EstatusController::class, 'store'])->name('estatus/new');
Route::post('estatus', [EstatusController::class, 'index'])->name('estatus');
Route::post('estatu', [EstatusController::class, 'show'])->name('estatu');
Route::post('estatus/update', [EstatusController::class, 'store'])->name('estatus/update');
Route::post('estatus/delete', [EstatusController::class, 'destroy'])->name('estatus/delete');

Route::post('libro/new', [LibroController::class, 'store'])->name('libro/new');
Route::post('libros', [LibroController::class, 'index'])->name('libros/new');
Route::post('libros/resenas', [LibroController::class, 'libros_resena'])->name('libros/resenas');
Route::post('libros/resenas/busqueda', [LibroController::class, 'busqueda_resena'])->name('libros/resenas/busqueda');
Route::post('libro', [LibroController::class, 'show'])->name('libro');
Route::post('libros/lector', [LibroController::class, 'show_libros_lector'])->name('libros/lector');
Route::post('libros/lector/completo', [LibroController::class, 'show_libros_resena_lector'])->name('libros/lector/completo');
Route::post('libros/lector/resenas', [LibroController::class, 'show_libros_resenas_lector'])->name('libros/lector/resenas');
Route::post('libro/resena', [LibroController::class, 'show_libro_resena'])->name('libro/resena');
Route::post('libro/update', [LibroController::class, 'store'])->name('libro/update');
Route::post('libro/delete', [LibroController::class, 'destroy'])->name('libro/delete');

Route::post('progeso/new', [ProgresoController::class, 'store'])->name('progeso/new');
Route::post('progesos', [ProgresoController::class, 'index'])->name('progesos/new');
Route::post('progeso', [ProgresoController::class, 'show'])->name('progeso');
Route::post('progeso/update', [ProgresoController::class, 'store'])->name('progeso/update');
Route::post('progeso/delete', [ProgresoController::class, 'destroy'])->name('progeso/delete');

Route::post('resena/new', [ResenaController::class, 'store'])->name('resena/new');
Route::post('resenas', [ResenaController::class, 'index'])->name('resenas');
Route::post('resena', [ResenaController::class, 'show'])->name('resena');
Route::post('resena/update', [ResenaController::class, 'store'])->name('resena/update');
Route::post('resena/delete', [ResenaController::class, 'destroy'])->name('resena/delete');

//user 
Route::post('persona/new', [UsuarioController::class, 'store'])->name('persona/new'); 
Route::post('personas', [UsuarioController::class, 'index'])->name('personas/new'); 
Route::post('persona', [UsuarioController::class, 'show'])->name('persona'); 
Route::post('persona/update', [UsuarioController::class, 'update'])->name('persona/update');
Route::post('persona/delete', [UsuarioController::class, 'destroy'])->name('persona/delete'); 

// --- RUTAS DE RECUPERACIÓN DE CONTRASEÑA (PASSWORD RESET) ---
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']); 
Route::post('password/reset', [ResetPasswordController::class, 'reset']);

Route::middleware([CorsMiddleware::class])->post('password/email', [PasswordController::class, 'sendResetLinkEmail']);
//Route::post('password/email', [PasswordController::class, 'sendResetLinkEmail']);

//Route::middleware([CorsMiddleware::class])->post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
