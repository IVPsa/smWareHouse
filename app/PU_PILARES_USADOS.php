<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PU_PILARES_USADOS extends Model
{
    //
    protected $table ="PU_PILARES_USADOS";

    protected $primaryKey = "PU_COD";

    protected $fillable = [

      'PU_PD_COD',
      'PU_CIR_COD'
    ];
}
