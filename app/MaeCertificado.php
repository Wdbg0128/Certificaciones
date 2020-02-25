<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaeCertificado extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mae_certificados';

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
    protected $fillable = ['Nombre_Certificado', 'Vigencia', 'Estado','concepto_aptitud'];


}
