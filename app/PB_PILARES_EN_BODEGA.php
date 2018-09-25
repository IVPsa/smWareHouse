<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PB_PILARES_EN_BODEGA extends Model
{
    //
    protected $table ="PB_PILARES_EN_BODEGA";

    protected $primaryKey = "TC_COD";

    protected $fillable = [

      'TC_DES',
      'TC_DIAMETRO'
    ];

}
