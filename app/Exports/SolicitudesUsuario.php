<?php

namespace App\Exports;

use App\Models\Solicitud;
use Maatwebsite\Excel\Concerns\FromCollection;

class SolicitudesUsuario implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    public function collection()
    {
        return Solicitud::where('activo', 1)->where('id_Usuario_Asignado', $this->id)->get();
    }
}
