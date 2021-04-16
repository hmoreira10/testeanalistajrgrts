<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdressResource extends JsonResource
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
            'id' => $this->id,
            'cep' => $this->cep,
            'patio' => $this->patio,
            'district' => $this->district,
            'complement' => $this->complement,
            'number' => $this->number,
            'city' => $this->city,
            'state' => $this->state,
            'fav' => $this->fav
        ];
    }
}
