<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TC_TIPO_CONEXION extends Model
{
    //
    protected $table ="TC_TIPO_CONEXION";

    protected $primaryKey = "TC_COD";

    protected $fillable = [

      'TC_DES',
      'TC_DIAMETRO'
    ];
}
