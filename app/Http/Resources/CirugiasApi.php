<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CirugiasApi extends JsonResource
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
        'CIR_NOMBRE_PACIENTE'=>$this->CIR_NOMBRE_PACIENTE,
        'CIR_RUT_PACIENTE'=>$this->CIR_RUT_PACIENTE,
        'CIR_FECHA'=>$this->CIR_FECHA,
        'CIR_DESCRIPCION'=>$this->CIR_DESCRIPCION,
        'CIR_ESTADO'=>$this->CIR_ESTADO,
      ];
    }
}
