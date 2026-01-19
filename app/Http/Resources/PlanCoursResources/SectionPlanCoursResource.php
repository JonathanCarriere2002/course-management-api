<?php

namespace App\Http\Resources\PlanCoursResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionPlanCoursResource extends JsonResource
{
    /**
     * Méthode qui reçoit les données d'une section associée
     * au plan de cours (avec pivot) et retourne un tableau qui contient
     * les données qui sont nécessaires à être envoyées.
     * @param  Request  $request
     * @return array un tableau avec les données d'une section associée au plan de cours (avec pivot) qui sont nécessaires à être envoyées (array)
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'info_suppl' => $this->pivot->info_suppl,
            'aide' => $this->aide,
            'texte' => $this->pivot->texte,
            'obligatoire' => $this->obligatoire,
            'type_section_id' => $this->type_section->id
        ];
    }
}
