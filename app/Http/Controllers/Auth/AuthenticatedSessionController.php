<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        $user = $request->user();
        $token = $user->createToken('token-name')->plainTextToken;

        switch ($user->rol->name) {
            case 'Admin':
                return response()->json(['token' => $token, 'message' => 'Inicio de sesión exitoso como administrador']);
                break;
            case 'User':
                return response()->json(['token' => $token, 'message' => 'Inicio de sesión exitoso como usuario']);
                break;
            case 'Company':
                return response()->json(['token' => $token, 'message' => 'Inicio de sesión exitoso como empresa']);
                break;
            default:
            return response()->json(['message' => 'Rol no reconocido: ' . $user->rol->name], 403);
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return Redirect::to('/')->with('message', 'Cierre de sesión exitoso');
    }
}
