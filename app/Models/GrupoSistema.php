<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GrupoSistema extends Model
{
    use HasFactory;
    protected $table = 'tblgrupos_sistema';
    protected $primaryKey = 'cve_GrupoSistema';
    protected $fillable = [
        'descripcion_grupo',
        'activo'
    ];
}
