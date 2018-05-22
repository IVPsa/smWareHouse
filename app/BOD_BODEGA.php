<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BOD_BODEGA extends Model
{
    //
    protected $table ="BOD_BODEGA";

    protected $primaryKey = "BOD_COD";

    protected $fillable = [

    'BOD_ART_COD'
    ];

    public function ART_ARTICULO()
    {
        return $this->hasMany('App\ART_ARTICULO', '{ART_COD', 'ART_ARTICULO');
    }
}
