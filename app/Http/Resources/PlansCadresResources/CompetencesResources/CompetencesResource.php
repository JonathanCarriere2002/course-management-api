<?php
/* @author lebel */
namespace App\Http\Resources\PlansCadresResources\CompetencesResources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompetencesResource extends JsonResource
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
            "code" => $this->code,
            "enonce" => $this->enonce,
            "annee_devis" => $this->annee_devis,
            "pages_devis" => $this->pages_devis,
            "contexte" => $this->contexte,
            "elementsCompetences" => ElementsCompetenceResource::collection($this->elements_competences),
            "programme_id" => $this->programme_id // TODO voir si le ->id est bon ou pas
        ];
    }
}
