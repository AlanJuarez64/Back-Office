<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;

class ArticuloController extends Controller
{
    public function VerTodo()
    {
        $articulos = Articulo::all();
        return view('entregas' , ['articulos' => $articulos]);
    }

    public function ConfirmarEntrega($id){
        $articulo = Articulo::findOrFail($id);
        $articulo->delete();
        return redirect('/entregas')->with('success_message', 'Entrega confirmada correctamente.');
    }
    
}
