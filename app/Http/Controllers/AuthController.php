<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;
class AuthController extends Controller
{
    public function register(Request $request){

        //se valida la información que viene en $request
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|string|max:80',
            'password' => 'required|string|min:8',
            'role' => 'required|string|max:50'
        ]);

        //se crea el usuario en la base de datos
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role']
        ]);

        //se crea token de acceso personal para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        //se devuelve una respuesta JSON con el token generado y el tipo de token
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

     public function login(Request $request){
        //valida las credenciales del usuario
        if (!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid access credentials'
            ], 200);
        }

        //Busca al usuario en la base de datos
        $user = User::where('email', $request['email'])->firstOrFail();

        //Genera un nuevo token para el usuario
        $token = $user->createToken('auth_token')->plainTextToken;

        //devuelve una respuesta JSON con el token generado y el tipo de token
        return response()->json([
            'status' => 'success',
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
    
    public function dataUser(Request $request){
        //devuelve la información del usuario
        return $request->user();
    }

    public function logout(){
        Auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 'success',
            'msg' => 'Sesión cerrada correctamente'
        ]);
    }
}
