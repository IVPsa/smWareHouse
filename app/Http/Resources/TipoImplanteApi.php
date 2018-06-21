<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TipoImplanteApi extends JsonResource
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
        'TI_COD'  =>$this->TI_COD,
        'TI_DES'  =>$this->TI_DES,
        'TI_CLASE' =>$this->TI_CLASE,
        'updated_at'=>$this->updated_at,
        'created_at'=>$this->created_at,
      ];
    }
}
