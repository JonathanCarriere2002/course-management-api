<?php

/**
 * @author Emeric Chauret
 */

namespace App\Http\Resources\PlanCoursResources;

use App\Http\Resources\PlansCadresResources\PlansCadres\PlansCadresResource;
use App\Http\Resources\SemaineCoursResources\SemaineCoursResource;
use App\Http\Resources\UserResources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanCoursResource extends JsonResource
{
    /**
     * Méthode qui reçoit les données d'un plan de cours
     * et retourne un tableau qui contient les données
     * qui sont nécessaires à être envoyées.
     * @param  Request  $request
     * @return array un tableau avec les données d'un plan de cours qui sont nécessaires à être envoyées (array)
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'gabarit' => $this->gabarit,
            'plan_cadre' => PlansCadresResource::make($this->plan_cadre),
            'campus' => $this->campus,
            'session' => $this->session,
            'approbation' => $this->approbation,
            'enseignants' => EnseignantPlanCoursResource::collection($this->enseignants),
            'sections' => SectionPlanCoursResource::collection($this->sections_en_ordre()),
            'semaines_cours' => SemaineCoursResource::collection($this->semaines_cours),
            'complet' => $this->complet,
            'cree_par' => UserResource::make($this->createur),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
