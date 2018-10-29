<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PB_PILARES_EN_BODEGA extends Model
{
    //
    protected $table ="PB_PILARES_EN_BODEGA";

    protected $primaryKey = "PB_COD";

    protected $fillable = [


      'PB_UDI_COMPLETO',
      'PB_LOTE',
      'PB_CANT',
      'PB_PL_COD'
    ];

}
