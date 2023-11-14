<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionarioTransporte extends Model
{
    use HasFactory;
    protected $table = 'Funcionario_Transporte';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
    ];


    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id');
    }
}
