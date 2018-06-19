<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class colorCoddingApi extends JsonResource
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
        'CLC_COLOR'=>$this->CLC_COLOR,
        'CLC_DESC'=>$this->CLC_DESC,
      ];
    }
}
