<?php

/**
 * @author Jacob Beauregard-Tousignant
 */

namespace App\Http\Resources\PlansCadresResources\CriteresEvaluation;

use App\Http\Resources\PlansCadresResources\CompetencesResources\ElementsCompetenceResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CriteresEvaluationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "enonce"=>$this->enonce,
            "ponderation"=>$this->ponderation,
            "elementsCompetence"=>CritereEvaluationElementCompetenceResource::collection($this->elements_competences)
        ];
    }
}
