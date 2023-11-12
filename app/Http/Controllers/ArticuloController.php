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
}
