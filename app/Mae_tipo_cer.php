<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mae_tipo_cer extends Model
{
    protected $table = 'mae_tipo_cer';

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
    protected $fillable = ['id','nombre_tipo_cer'];

}

