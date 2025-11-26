<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        // Intentar enviar el enlace de restablecimiento de contraseña
        $response = Password::sendResetLink($request->only('email'));

        // Si el enlace se envió correctamente
        if ($response == Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'El link se ha envíado correctamente'], 200);
        }

        // Si ocurrió un error
        return response()->json(['message' => 'No se encontró el correo ingresado.'], 500);
    }
}
