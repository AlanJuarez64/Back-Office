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
        $funcionarioAlmacen = $almacen->funcionariosAlmacen->first();
        $empleado = $funcionarioAlmacen->empleado;
        $user = $empleado -> user;
        $productos = $almacen->productos;

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
    
}

