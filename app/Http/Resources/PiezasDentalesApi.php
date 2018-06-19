<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PiezasDentalesApi extends JsonResource
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

        'PD_SECTOR'=>$this->$PD_SECTOR,
        'PD_N_DIENTE'=>$this->$PD_N_DIENTE,
        'PD_NOMBRE'=>$this->$PD_NOMBRE,
        'updated_at'=>$this->updated_at,
        'created_at'=>$this->created_at,

      ];
    }
}
