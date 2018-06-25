<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IucApi extends JsonResource
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
       'IUC_ART_COD' =>$this->IUC_ART_COD,
       'IUC_CIR_COD' =>$this->IUC_CIR_COD,
       'IUC_PD_COD' =>$this->IUC_PD_COD,
       'IUC_FECHA_DE_USO' => $this->IUC_FECHA_DE_USO,
       'updated_at'=>$this->updated_at,
       'created_at'=>$this->created_at,
      ];
    }
}
