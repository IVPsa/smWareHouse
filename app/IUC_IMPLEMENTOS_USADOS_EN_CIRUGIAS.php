<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS extends Model
{
    //

    protected $table ="IUC_IMPLEMENTOS_USADOS_EN_CIRUGIAS";

    protected $primaryKey = "UIC_COD";

    protected $fillable = [
      'IUC_ART_COD',
      'IUC_CIR_COD',
      'UIC_PD_COD'
    ];

    public function TC_TIPO_CONEXION()
    {
        return $this->hasmany('App\PD_PIEZAS_DENTALES', '{PD_COD', 'PD_PIEZAS_DENTALES');
        return $this->hasOne('App\CIR_CIRUGIA', '{CIR_COD', 'CIR_CIRUGIA');
        return $this->hasmany('App\ART_ARTICULO', '{ART_COD', 'ART_ARTICULO');
    }
}
