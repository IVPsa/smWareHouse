<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductosApi extends JsonResource
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
      'PROD_NOMBRE'=>$this->PROD_NOMBRE,
      'PROD_DESCRIPCION'=>$this->PROD_DESCRIPCION,
      'PROD_N_ARTICULO'=>$this->PROD_N_ARTICULO,
      'PROD_DIAMETRO'=>$this->PROD_DIAMETRO,
      'PROD_LONGITUD'=>$this->PROD_LONGITUD,
      'PROD_UDI_01'=>$this->PROD_UDI_01,
      'PROD_USU_COD'=>$this->PROD_USU_COD,
      'PROD_CLC_COD'=>$this->PROD_CLC_COD,
      'PROD_TC_COD'=>$this->PROD_TC_COD,
      'PROD_TI_COD'=>$this->PROD_TI_COD,

      'updated_at'=>$this->updated_at,
      'created_at'=>$this->created_at,
      ];
    }
}
