<?php

namespace App\Http\Resources\PlanCoursResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnseignantPlanCoursResource extends JsonResource
{
    /**
     * Méthode qui reçoit les données d'un enseignant associé
     * au plan de cours (avec pivot) et retourne un tableau qui contient
     * les données qui sont nécessaires à être envoyées.
     * @param  Request  $request
     * @return array un tableau avec les données d'un enseignant associé au plan de cours (avec pivot) qui sont nécessaires à être envoyées (array)
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nom' => $this->prenom.' '.$this->nom,
            'groupe' => $this->pivot->groupe,
            'dispo' => $this->pivot->dispo,
            'bureau' => $this->bureau,
            'courriel' => $this->courriel,
            'poste' => $this->poste,
        ];
    }
}
