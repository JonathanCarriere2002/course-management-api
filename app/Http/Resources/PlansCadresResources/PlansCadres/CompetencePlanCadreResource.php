<?php

/**
 * @author Jacob Beauregard-Tousignant
 */

namespace App\Http\Resources\PlansCadresResources\PlansCadres;

use App\Http\Resources\PlansCadresResources\CompetencesResources\CompetencesResource;
use App\Models\Competence;
use App\Models\PlanCadre;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompetencePlanCadreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "competence"=>CompetencesResource::make(Competence::find($this->pivot->competence_id)),
            "planCadre"=>PlanCadreAbregePourCompetencePlanCadreResource::make(PlanCadre::find($this->pivot->plan_cadre_id)),
            "atteinte"=>$this->pivot->Atteinte,
            "progression"=>$this->pivot->Completion,
            "contexteLocal"=>$this->pivot->ContexteLocal
        ];
    }
}
