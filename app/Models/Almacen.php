<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    protected $table = 'Almacenes';
    protected $primaryKey = 'ID_Almacen';
    public $timestamps = true;
    protected $fillable = [
        'Capacidad',
    ];

    public function funcionariosAlmacen()
    {
        return $this->hasMany(FuncionarioAlmacen::class, 'ID_Almacen');
    }

    public function productos() {
        return $this->belongsToMany(Producto::class, 'Guarda', 'ID_Almacen', 'ID_Producto');
    }

}
