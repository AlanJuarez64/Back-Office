<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class usuarioController extends Controller
{

    public function verTodos()
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }



    public function Registrar(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create($data);

        return response()->json(['message' => 'Usuario creado con éxito', 'data' => $user], 201);
    }



    

    public function Buscar($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        return response()->json(['data' => $user], 200);
    }


    public function Modificar(Request $request, $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $data = $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $id,
            'password' => 'string|min:6',
        ]);

        $user->update($data);

        return response()->json(['message' => 'Usuario actualizado con éxito', 'data' => $user], 200);
    }

    public function Eliminar($id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuario eliminado con éxito'], 204);
    }



}
