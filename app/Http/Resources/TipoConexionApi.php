<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoConexionApi extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return [

        'TC_DES' =>$this->$TC_DES,
        'TC_DIAMETRO'=>$this->$TC_DIAMETRO,
        'updated_at'=>$this->updated_at,
        'created_at'=>$this->created_at,
      ];
    }
}
