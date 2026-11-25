<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //busca al usuario por email, comprueba la contraseña con Hash::check y, si es correcta, crea un token y lo devuelve.
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    //Ruta register
    public function register(Request $request)
    {
        //Valido los datos antes de crear el usuario 
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        //Creo el usuario 
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        //Genero el token 
        $token = $user->createToken('api-token')->plainTextToken;

        //Mando respuesta en formato json
        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }

    //borra el token que se usó en la petición, y deja de valer.
    public function logout(Request $request)
    {
        //Destruyo el token del usuario
        $request->user()->currentAccessToken()->delete();

        //Respondo con un mensaje de confirmación formato json
        return response()->json(['message' => 'Sesión cerrada']);
    }
}
