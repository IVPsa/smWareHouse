<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CIR_CIRUGIA extends Model
{
    //
    //
    protected $table ="CIR_CIRUGIA";

    protected $primaryKey = "CIR_COD";

    protected $fillable = [

    'CIR_NOMBRE_PACIENTE',
    'CIR_RUT_PACIENTE',
    'CIR_FECHA',
    'CIR_DESCRIPCION',
    'CIR_ESTADO'
    ];
}
