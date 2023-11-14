<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionarioAlmacen extends Model
{
    use HasFactory;
    protected $table = 'Funcionario_Almacen';

    protected $primaryKey = 'id';

    protected $fillable = [
        'ID_Almacen',

    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id');
    }
}
