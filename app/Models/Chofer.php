<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chofer extends Model
{
    use HasFactory;
    protected $table = 'Chofer';

    protected $primaryKey = 'ID_Usuario';

    protected $fillable = [
        'ID_Usuario',
        'Licencia',
    ];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'ID_Usuario');
    }

}
