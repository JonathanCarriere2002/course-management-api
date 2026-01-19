<?php

/**
 * @author Emeric Chauret
 */

namespace App\Http\Resources\GabaritResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GabaritResource extends JsonResource
{
    /**
     * Méthode qui reçoit les données d'un gabarit
     * et retourne un tableau qui contient les données
     * qui sont nécessaires à être envoyées.
     * @param  Request  $request
     * @return array un tableau avec les données d'un gabarit qui sont nécessaires à être envoyées (array)
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'sections' => SectionGabaritResource::collection($this->sections)
        ];
    }
}
