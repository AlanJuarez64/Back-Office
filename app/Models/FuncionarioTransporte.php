<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionarioTransporte extends Model
{
    use HasFactory;
    protected $table = 'Funcionario_Transporte';

    protected $primaryKey = 'ID_Usuario';

    protected $fillable = [
        'ID_Usuario',
    ];


    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_Usuario');
    }
}
