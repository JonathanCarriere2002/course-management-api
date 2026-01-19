<?php

namespace App\Http\Resources\SessionResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Ressource permettant d'exporter des plans de cours des sessions en JSON
 * Cette ressource permet de grandement optimiser les requêtes de l'API
 * @author Jonathan Carrière
 */
class SessionPlanCoursResource extends JsonResource
{
    /**
     * Méthode permettant d'exporter des plans de cours des sessions en JSON
     * @param Request $request Requête utilisée pour l'exportation
     * @return array Array contenant les plans de cours des sessions sous le format JSON
     */
    public function toArray(Request $request): array
    {
        // Retourner les plans de cours des sessions convertis sous le format JSON
        return [
            'id' => $this->id,
            'plan_cadre' => SessionPlanCadreResource::make($this->plan_cadre)
        ];
    }
}
