<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PL_PILARES extends Model
{
    //
    protected $table ="PL_PILARES";

    protected $primaryKey = "TC_COD";

    protected $fillable = [

      'TC_DES',
      'TC_DIAMETRO'
    ];
}
