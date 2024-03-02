<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'adress' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'rol_id' => ['required', 'exists:rols,id'], // Asegura que el rol_id existe en la tabla roles
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'adress' => $request->adress,
            'phone' => $request->phone,
            'rol_id' => $request->rol_id,
            'password' => Hash::make($request->password),
        ]);
    
    
        event(new Registered($user));

        // Autenticar al usuario recién registrado
        Auth::login($user);
    
        // Crea un token de acceso para el usuario recién registrado
        $token = $user->createToken('api-token')->plainTextToken;
        
    
        return response()->json(['message' => 'Usuario registrado correctamente', 'token' => $token], 201);
    }
}
