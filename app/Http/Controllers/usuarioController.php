<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class usuarioController extends Controller
{
    public function Registrar(Request $request)

    {
        $accessToken = $request->user()->token->accessToken;

        $response = Http::post('http://localhost:8001/api/user', [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        return response()->json(['message' => 'Usuario registrado exitosamente']);

}


    public function Buscar(Request $request){

        $accessToken = $request->user()->token->accessToken;

        $id = $request->input('id');
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get('http://localhost:8001/api/' . $id);
    
        if ($response->successful()) {
            $usuario = $response->json();
            return response()->json(['usuario' => $usuario]);
        } else {
            return response()->json(['error' => 'Error al buscar el usuario'], 500);
        }

    }
}
