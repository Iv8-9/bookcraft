<?php

use Illuminate\Http\Request;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LibroController;
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

Route::post('resena/new', [ResenaController::class, 'store'])->name('resena/new');
Route::post('resenas', [ResenaController::class, 'index'])->name('resenas');
Route::post('resena', [ResenaController::class, 'show'])->name('resena');
Route::post('resena/update', [ResenaController::class, 'store'])->name('resena/update');
Route::post('resena/delete', [ResenaController::class, 'destroy'])->name('resena/delete');

//user 
Route::post('persona/new', [UsuarioController::class, 'store'])->name('persona/new'); 
Route::post('persona/premium', [UsuarioController::class, 'premium'])->name('persona/premium'); 
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


Route::post('libros/resenas/buscar', [LibroController::class, 'buscar_libros_resenas']);
