<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ART_ARTICULO extends Model
{
    //
        protected $table ="ART_ARTICULO";

        protected $primaryKey = "ART_COD";

        protected $fillable = [

        'ART_UDI',
        'ART_PROD_COD'
        ];

        public function PRO_PRODUCTOS()
        {
            return $this->hasOne('App\PRO_PRODUCTOS', '{PROD_COD', 'PRO_PRODUCTOS');
        }
}
