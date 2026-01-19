<?php

/**
 * @author Emeric Chauret
 */

namespace App\Http\Resources\SectionResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    /**
     * Méthode qui reçoit les données d'une section
     * et retourne un tableau qui contient les données
     * qui sont nécessaires à être envoyées.
     * @param  Request  $request
     * @return array un tableau avec les données d'une section qui sont nécessaires à être envoyées (array)
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'info_suppl' => $this->info_suppl,
            'aide' => $this->aide,
            'obligatoire' => $this->obligatoire,
            'type_section_id' => $this->type_section_id
        ];
    }
}
