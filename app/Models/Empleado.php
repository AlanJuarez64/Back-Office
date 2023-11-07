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

}
