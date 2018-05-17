<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CLC_COLOR_CODING extends Model
{
    //
    protected $table ="CLC_COLOR_CODING";

    protected $primaryKey = "CLC_COD";

    protected $fillable = [

      'CLC_COLOR',
      'CLC_DESC'
    ];
}
