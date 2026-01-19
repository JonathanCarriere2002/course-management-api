<?php

/**
 * @author Emeric Chauret
 */

namespace App\Http\Resources\CampusResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CampusResource extends JsonResource
{
    /**
     * Méthode qui reçoit les données d'un campus
     * et retourne un tableau qui contient les données
     * qui sont nécessaires à être envoyées.
     * @param  Request  $request
     * @return array un tableau avec les données d'un campus qui sont nécessaires à être envoyées (array)
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom
        ];
    }
}
