<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionCarga extends Model
{
    use HasFactory;
    protected $table = 'tblconfiguracioncarga';
    protected $primaryKey = 'id_Configuracion_Carga';
    protected $fillable = [
        'proporcion',
        'diferencia',
        'anio'
    ];
}
