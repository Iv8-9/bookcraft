<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    // Usa el trait ResetsPasswords que contiene la lógica principal
    use ResetsPasswords;

    /**
     * Donde redirigir a los usuarios después de restablecer la contraseña.
     * Este valor es ignorado por sendResetResponse.
     *
     * @var string
     */
    protected $redirectTo = '/home'; // Puedes dejar /home

    /**
     * Obtiene la respuesta de restablecimiento de contraseña para un restablecimiento exitoso.
     * Sobreescrito para forzar una respuesta JSON 200 en lugar de redirección.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        // El restablecimiento fue exitoso, devolvemos JSON 200
        return new JsonResponse([
            'message' => trans($response),
            'status' => 'success',
        ], 200);
    }

    /**
     * Obtiene la respuesta de restablecimiento de contraseña para un restablecimiento fallido.
     * Sobreescrito para forzar una respuesta JSON 400 en lugar de redirección (302).
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        // Verificamos si la solicitud es de API (JSON)
        if ($request->wantsJson() || $request->isJson()) {
            
            // Devolvemos un 400 Bad Request con el mensaje de error de Laravel (ej. "This password reset token is invalid.")
            return new JsonResponse([
                'message' => trans($response),
                'error_code' => $response,
            ], 400); 
        }

        // Para uso web (si no es API), mantiene la lógica original de redirección
        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }
}