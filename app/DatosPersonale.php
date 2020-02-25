<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatosPersonale extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'datos_personales';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['Num_Sap', 'Identificacion', 'Apellidos_Nombres','Gerancia','Planta','Cargo','Fin_Contrato'];


}
