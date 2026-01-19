<?php

/**
 * @author Jacob Beauregard-Tousignant
 */


namespace App\Http\Resources\PlansCadresResources\PlansCadres;

use App\Http\Resources\PlansCadresResources\CompetencesResources\CompetencesResource;
use App\Models\Competence;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanCadreAbregeResource extends JsonResource
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
            'titre'=>$this->titre,
            'code'=>$this->code,
            'attitudes'=>$this->attitudes,
            'ponderation'=>$this->ponderation,
            'complet'=>$this->complet,
            'competences'=>CompetencePlanCadreResource::collection($this->competence),
        ];
    }
}
