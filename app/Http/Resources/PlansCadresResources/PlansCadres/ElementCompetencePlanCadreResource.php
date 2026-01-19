<?php

namespace App\Http\Resources\PlansCadresResources\PlansCadres;

use App\Http\Resources\PlansCadresResources\CompetencesResources\ElementsCompetenceResource;
use App\Models\Competence;
use App\Models\ElementCompetence;
use App\Models\PlanCadre;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElementCompetencePlanCadreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'elementCompetence'=>ElementsCompetenceResource::make(ElementCompetence::find($this->pivot->id_element_compe)),
            'planCadreId'=>$this->pivot->plan_cadre_id,
            'contenuLocal'=>$this->pivot->contenu_local
        ];
    }
}
