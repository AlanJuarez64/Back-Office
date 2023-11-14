<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'Productos';
    protected $primaryKey = 'ID_Producto';

    protected $fillable = [
        'id',
        'Peso',
        'Cantidad',
        'created_at',
        'updated_at',
    ];

    public function articulos() {
        return $this->hasMany(Articulo::class, 'ID_Producto');
    }

    public function almacenes() {
        return $this->belongsToMany(Almacenes::class, 'Guarda', 'ID_Producto', 'ID_Almacen');
    }

}
