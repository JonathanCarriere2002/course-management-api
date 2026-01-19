<?php

/**
 * @author Emeric Chauret
 */

namespace App\Http\Resources\SectionResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeSectionResource extends JsonResource
{
    /**
     * Méthode qui reçoit les données d'un type de section
     * et retourne un tableau qui contient les données
     * qui sont nécessaires à être envoyées.
     * @param  Request  $request
     * @return array un tableau avec les données d'un type de section qui sont nécessaires à être envoyées (array)
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type
        ];
    }
}
