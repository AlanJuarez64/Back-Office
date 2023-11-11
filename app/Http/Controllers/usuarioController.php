<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Empleado;
use App\Models\Chofer;
use App\Models\FuncionarioAlmacen;
use App\Models\FuncionarioTransporte;
use App\Models\Despachador;

class UsuarioController extends Controller
{

    public function verTodos()
    {
        $users = User::all();
        return view('usuarios', ['users' => $users]);
    }


    public function Registrar(Request $request)
    {
        try{
        $validation = Validator::make($request->all(),[
            'name' => 'required|string',
            'nombre_completo' => 'required|string',
            'ci' => 'required|int|unique:users,ci|digits:8',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        
        $validation->validate();
    
        $user = $this->createUser($request);
        $empleado = $this-> crearEmpleado($user->id);
        $tipoUsuario = $this->definirTipoUsuario($request->input('tipo_usuario'), $user->id);

        $message = "Usuario $user->name, con características de $tipoUsuario creado correctamente.";
    
        return redirect('/usuarios')->with('success_message', $message);
        }catch (ValidationException $e) {

            $errors = $e->errors();
            return redirect('/usuarios')->withErrors([$errors]);
        }
        
    }


    private function createUser($request){
        $user = new User();
        $user -> name = $request -> post("name");
        $user -> email = $request -> post("email");
        $user -> password = Hash::make($request -> post("password"));   
        $user -> Nombre_Completo = $request -> post("nombre_completo");
        $user -> CI = $request -> post("ci");
        $user -> save();

        return $user;
    }

    private function crearEmpleado($userId){
        $empleado = new Empleado();
        $empleado->ID_Usuario = $userId;
        $empleado->save();

        return $empleado;
    }

    private function definirTipoUsuario($tipoUsuario, $idEmpleado){
        
        $clasesdeTiposUsuario = [
            'funcionario_de_transporte' => FuncionarioTransporte::class,
            'funcionario_de_almacen' => FuncionarioAlmacen::class,
            'chofer' => Chofer::class,
            'despachador' => Despachador::class,
        ];
        
        
        if (array_key_exists($tipoUsuario, $clasesdeTiposUsuario)) {
            $obtenerClasesDeUsuario = $clasesdeTiposUsuario[$tipoUsuario];
            $usuario = new $obtenerClasesDeUsuario;
            $usuario->ID_Usuario = $idEmpleado;
            $usuario->save();
            return $tipoUsuario;
        }
        throw new \Exception('Tipo de usuario no válido');
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
            'name' => 'required|string',
            'nombre_completo' => 'required|string',
            'ci' => 'required|numeric|digits:8|unique:users,ci,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|string|min:6',
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'Nombre_Completo' => $data['nombre_completo'],
            'CI' => $data['ci'],
        ]);

        $message = "El usuario $user->name fue modificado correctamente";
        return redirect('/usuarios')->with('success_message', $message);
    }


    public function Eliminar($id) {
        try{
        $user = User::findOrFail($id);
        $empleado = Empleado::where('ID_Usuario', $id)->first();

        if ($empleado) {
            if ($empleado->funcionarioTransporte) {
                FuncionarioTransporte::where('ID_Usuario', $id)->delete();
            } elseif ($empleado->funcionarioAlmacen) {
                FuncionarioAlmacen::where('ID_Usuario', $id)->delete();
            } elseif ($empleado->chofer) {
                Chofer::where('ID_Usuario', $id)->delete();
            } elseif ($empleado->despachador) {
                Despachador::where('ID_Usuario', $id)->delete();
            }

            $empleado->delete();
        }
            $user->delete();
    

            return redirect('/usuarios')->with('success_message', 'Usuario eliminado correctamente');
        } catch (\Exception $e) {
            redirect('/usuarios')->withErrors(['error' => 'Error al eliminar el usuario']);
        }
    }
    }
    
