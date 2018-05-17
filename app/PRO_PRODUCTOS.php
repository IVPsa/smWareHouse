<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PRO_PRODUCTOS extends Model
{
    //

    protected $table ="PRO_PRODUCTOS";

    protected $primaryKey = "PROD_COD";

    protected $fillable = [
      'PROD_NOMBRE',
      'PROD_DESCRIPCION',
      'PROD_N_ARTICULO',
      'PROD_DIAMETRO',
      'PROD_LONGITUD',
      'PROD_USU_COD',
      'PROD_CLC_COD',
      'PROD_TC_COD',
      'PROD_TI_COD'
    ];

    public function TC_TIPO_CONEXION()
    {
        return $this->hasOne('App\TC_TIPO_CONEXION', '{TC_COD', 'TC_TIPO_CONEXION');
    }

    public function CLC_COLOR_CODING()
    {
        return $this->hasOne('App\CLC_COLOR_CODING', '{CLC_COD', 'CLC_COLOR_CODING');
    }

    public function TI_TIPO_IMPLANTE()
    {
        return $this->hasOne('App\TI_TIPO_IMPLANTE', '{TI_COD', 'TI_TIPO_IMPLANTE');
    }

}
