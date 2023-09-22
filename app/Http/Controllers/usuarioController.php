<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsuarioController extends Controller
{

    public function verTodos()
    {
        $users = User::all();
        return view('usuarios', ['users' => $users]);
    }


    public function Registrar(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);
        
        if ($validation->fails()) {
            return redirect('/usuarios')->withErrors($validation)->withInput();
        }
    
        $user = $this->createUser($request);
        $message = "Usuario $user->name creado correctamente";
    
        return redirect('/usuarios')->with('success_message', $message);
        
    }
    

    public function Buscar(Request $request,$id)
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

         return view('usuarios', ['user' => $user]);
    }



    private function createUser($request){
        $user = new User();
        $user -> name = $request -> post("name");
        $user -> email = $request -> post("email");
        $user -> password = Hash::make($request -> post("password"));   
        $user -> save();
        return $user;
    }
}
