<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despachador extends Model
{
    use HasFactory;
    protected $table = 'Despachadores';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id');
    }
}
