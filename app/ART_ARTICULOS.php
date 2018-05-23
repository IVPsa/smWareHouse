<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ART_ARTICULOS extends Model
{
    //
        protected $table ="ART_ARTICULOS";

        protected $primaryKey = "ART_COD";

        protected $fillable = [

        'ART_UDI',
        'ART_PROD_COD',
        'ART_FECHA_EXP',
        'ART_LOTE',
        'ART_CANT'
        ];

        public function PRO_PRODUCTOS()
        {
            return $this->hasOne('App\PRO_PRODUCTOS', '{PROD_COD', 'PRO_PRODUCTOS');
        }
}
