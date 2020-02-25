<?php

namespace App\Imports;

use App\CerRegistro;
use Maatwebsite\Excel\Concerns\ToModel;

class CerRegistrosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new CerRegistro([
            'Num_Sap' =>$row[0],    //a
            'tipo_id' =>$row[1],//g
            'maecertificado_id' =>$row[2], //b
            'nivel_id' =>$row[3],//h
            'fecha_Expedicion' =>$row[4],//c
            'fecha_Fin' =>$row[5],//c
            'maeentecertificador_id' =>$row[6],//d
            'archivo' =>'NoFoun',
            'estado' =>1,
        ]);
    }
}

