<?php

/**
 * @author Jacob Beauregard-Tousignant
 */


namespace App\Http\Resources\PlansCadresResources\CriteresEvaluation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CritereEvaluationElementCompetenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'numero'=>$this->numero,
            'texte'=>$this->texte
        ];
    }
}
