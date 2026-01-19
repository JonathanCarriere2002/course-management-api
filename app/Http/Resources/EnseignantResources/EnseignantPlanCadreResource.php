<?php

namespace App\Http\Resources\EnseignantResources;

use App\Http\Resources\PlansCadresResources\PlansCadres\CompetencePlanCadreResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Ressource permettant d'exporter des plans-cadres associés aux plans de cours des enseignants en JSON
 * Cette ressource permet de grandement optimiser les requêtes de l'API
 * @author Jonathan Carrière
 */
class EnseignantPlanCadreResource extends JsonResource
{
    /**
     * Méthode permettant d'exporter des plans-cadres associés aux plans de cours des enseignants en JSON
     * @param Request $request Requête utilisée pour l'exportation
     * @return array Array contenant les plans-cadres associés aux plans de cours des enseignants sous le format JSON
     */
    public function toArray(Request $request): array
    {
        // Retourner les plans-cadres associés aux plans de cours des enseignants convertis sous le format JSON
        return [
            "id" => $this->id,
            "code" => $this->code,
            "titre" => $this->titre,
            "ponderation" => $this->ponderation,
            "competences" => CompetencePlanCadreResource::collection($this->competence)
        ];
    }
}
