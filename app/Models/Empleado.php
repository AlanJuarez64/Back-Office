<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table = 'Empleados';

    protected $primaryKey = 'id';

    public $timestamps = true;
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function funcionarioTransporte() {
        return $this->hasOne(FuncionarioTransporte::class, 'id');
    }

    public function funcionarioAlmacen() {
        return $this->hasOne(FuncionarioAlmacen::class, 'id');
    }

    public function chofer() {
        return $this->hasOne(Chofer::class, 'id');
    }

    public function despachador() {
        return $this->hasOne(Despachador::class, 'id');
    }

}
