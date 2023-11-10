<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'Empleados';

    protected $primaryKey = 'ID_Usuario';

    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class, 'ID_Usuario', 'id');
    }

    public function funcionarioTransporte() {
        return $this->hasOne(FuncionarioTransporte::class, 'ID_Usuario');
    }

    public function funcionarioAlmacen() {
        return $this->hasOne(FuncionarioAlmacen::class, 'ID_Usuario');
    }

    public function chofer() {
        return $this->hasOne(Chofer::class, 'ID_Usuario');
    }

    public function despachador() {
        return $this->hasOne(Despachador::class, 'ID_Usuario');
    }

}
