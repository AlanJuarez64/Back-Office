<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Almacen;
use App\Models\User;
use App\Models\Empleado;
use App\Models\Chofer;
use App\Models\FuncionarioAlmacen;
use App\Models\Producto;

class AlmacenController extends Controller
{

    public function VerTodo()
    {
        $almacenes = Almacen::all();
        return view('almacenes' , ['almacenes' => $almacenes]);
    }


    public function verMas($id)
    {
        $almacen = Almacen::findOrFail($id);
        $productos = $almacen->productos;

        if ($almacen->funcionariosAlmacen->isEmpty()) {
            $message = "No se ha asignado un funcionario al almacén.";
            return view('almacenInfo', [
                'almacen' => $almacen, 
                'productos' => $productos,
                'message' => $message]);
        }
        
        $funcionarioAlmacen = $almacen->funcionariosAlmacen->first();
        $empleado = $funcionarioAlmacen->empleado;
        $user = $empleado -> user;
        

        return view('almacenInfo' , [
            'almacen' => $almacen, 
            'productos' => $productos,
            'funcionarioAlmacen' => $funcionarioAlmacen,
            'user' => $user
        ]);
    }

    
    public function Registrar(Request $request){
        $request->validate([
            'Capacidad' => 'required|integer|min:10'
        ]);

        $almacen = Almacen::create($request->all());
        $almacen->save();
        $almacenes = Almacen::all();
        $message = "Almacén creado correctamente";
        return view('almacenes', [ 'message' => $message, 'almacenes' => $almacenes ]);
    }

    public function Eliminar($id)
    {
        $almacen = Almacen::findOrFail($id);

        $registro = Almacen::with('funcionariosAlmacen')->findOrFail($id);

        $registro->funcionariosAlmacen->each(function ($funcionario) {
            $funcionario->ID_Almacen = null;
            $funcionario->save();
        });

        $almacen->delete();
        $message = "Almacén eliminado correctamente";
        return redirect('/almacenes')->with('success_message', $message);

        }

    public function Modificar(Request $request, $id)
    {
        $request->validate([
            'Capacidad' => 'required|integer|min:10'
        ]);

        $almacen = Almacen::findOrFail($id);
        $almacen->update($request->all());

        $message = "Almacén modificado correctamente";
        return redirect('/almacenes')->with('success_message', $message);
    }

    public function CambiarFuncionario($id, Request $request){
        $almacen = Almacen::findOrFail($id);
        $funcionarioActual = $almacen->funcionariosAlmacen->first();

        $request->validate([
            'idUsuario' => 'required|int|min:1'
        ]);

        $idFuncionarioNuevo = $request ->input("idUsuario");
        $nuevoFuncionario = FuncionarioAlmacen::where('ID_Usuario', $idFuncionarioNuevo)->first();

        if (!$nuevoFuncionario) {
            $message = "El usuario no existe o no es un funcionario de almacén.";
            return redirect("/almacenes/$id")->withErrors(['error_message' => $message]);
        }

        if ($funcionarioActual) {
            $funcionarioActual->update(['ID_Almacen' => null]);
        }

        $nuevoFuncionario->update(['ID_Almacen' => $almacen->ID_Almacen]);
            
        $message = "Funcionario asignado correctamente";
        return redirect("/almacenes/$id")->with('success_message', $message);

    }
    
}

