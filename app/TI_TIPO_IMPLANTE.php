<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TI_TIPO_IMPLANTE extends Model
{
    //
    protected $table ="TI_TIPO_IMPLANTE";

    protected $primaryKey = "TI_COD";

    protected $fillable = [

      'TI_DES',
      'TI_CLASE'
    ];
}
