<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaeEnteCertificador extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mae_ente_certificadors';

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
    protected $fillable = ['Nombre_EnteCertificador', 'Estado'];

    
}
