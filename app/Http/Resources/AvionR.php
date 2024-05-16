<?php

namespace App\Http\Resources;

use App\Models\Tip;
use App\Models\Proizvodjac;
use Illuminate\Http\Resources\Json\JsonResource;

class AvionR extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $tip = Tip::find($this->tipID);
        $proizvodjac = Proizvodjac::find($this->proizvodjacID);

        return [
            'id' => $this->id,
            'proizvodjac' => $proizvodjac->proizvodjac,
            'model' => $this->model,
            'tip' => $tip->tip,
            'opis' => $this->opis
        ];
    }
}
