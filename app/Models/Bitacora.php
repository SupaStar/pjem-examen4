<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    protected $table = 'tblbitacoras';
    protected $primaryKey = 'id-Bitacora';
    protected $fillable = ['id-Bitacora', 'id_Usuario', 'cve_Accion', 'fecha', 'movimiento'];
}
