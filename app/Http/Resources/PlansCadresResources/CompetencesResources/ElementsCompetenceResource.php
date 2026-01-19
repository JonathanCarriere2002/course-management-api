<?php
/* @author lebel */
namespace App\Http\Resources\PlansCadresResources\CompetencesResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElementsCompetenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "numero" => $this->numero,
            "texte" => $this->texte,
            "criteresPerformance" => CriteresPerformanceResource::collection($this->criteres_performances),
            "isExpanded" => false
        ];
    }
}
