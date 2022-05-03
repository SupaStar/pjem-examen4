<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    use HasFactory;
    protected $table = 'tblsolicitudes';
    protected $primaryKey = 'id_solicitud';
    protected $fillable = [
        'id_Usuario_Asignado',
        'nombre_Solicitante',
        'paterno_Solicitante',
        'materno_Solicitante',
        'activo',
        'fecha_Solicitud'
    ];
    public function usuario()
    {
        return $this->belongsTo('App\Models\User', 'id_Usuario_Asignado');
    }
}
