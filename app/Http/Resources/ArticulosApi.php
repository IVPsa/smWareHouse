<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticulosApi extends JsonResource
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
       'ART_COD' =>$this->ART_COD,
       'ART_UDI' =>$this->ART_UDI,
       'ART_PROD_COD' =>$this->ART_PROD_COD,
       'ART_FECHA_EXP' => $this->ART_FECHA_EXP,
       'ART_LOTE' =>$this->ART_LOTE,
       'ART_CANT' => $this->ART_CANT,
       'updated_at'=>$this->updated_at,
       'created_at'=>$this->created_at,
       //FK
       'PROD_UDI_01'=>$this->PROD_UDI_01,
      ];
    }
}
