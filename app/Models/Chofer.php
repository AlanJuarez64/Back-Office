<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    use HasFactory;
    protected $table = 'Choferes';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'Licencia',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id');
    }

}
