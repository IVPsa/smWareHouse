<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PL_PILARES extends Model
{
    //
    protected $table ="PL_PILARES";

    protected $primaryKey = "PL_COD";

    protected $fillable = [

        'PL_NOMBRE',
        'PL_DESCRIPCION',
        'PL_UDI01',
        'PL_N_ARTICULO',
        'PL_TP_COD'
    ];
}
