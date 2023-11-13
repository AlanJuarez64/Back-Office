<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionarioAlmacen extends Model
{
    use HasFactory;
    protected $table = 'Funcionario_Almacen';

    protected $primaryKey = 'ID_Usuario';

    protected $fillable = [
        'ID_Almacen',
        
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_Usuario');
    }
}
