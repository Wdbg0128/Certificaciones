<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mae_nivel_cer extends Model
{
    protected $table = 'mae_nivel_cer';

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
    protected $fillable = ['id','nombre_nivel_cer'];
}
