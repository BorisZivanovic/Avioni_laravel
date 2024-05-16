<?php

namespace App\Http\Resources;

use App\Models\Avion;
use App\Models\Tip;
use App\Models\Proizvodjac;
use Illuminate\Http\Resources\Json\JsonResource;

class LetR extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $avion = Avion::find($this->avionID);
        $tip = Tip::find($avion->tipID);
        $proizvodjac = Proizvodjac::find($avion->proizvodjacID);

        return [
            'id' => $this->id,
            'polaziste' => $this->polaziste,
            'odrediste' => $this->odrediste,
            'datum' => $this->datum,
            'avion' => $proizvodjac->proizvodjac
        ];
    }
}
