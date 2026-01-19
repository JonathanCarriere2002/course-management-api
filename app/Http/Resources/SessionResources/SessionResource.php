<?php

namespace App\Http\Resources\SessionResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Ressource permettant d'exporter des sessions en JSON
 * @author Jonathan Carrière
 */
class SessionResource extends JsonResource
{
    /**
     * Méthode permettant d'exporter des sessions en JSON
     * @param Request $request Requête utilisée pour l'exportation
     * @return array Array contenant les sessions sous le format JSON
     */
    public function toArray(Request $request): array
    {
        // Retourner les sessions converties sous le format JSON
        return [
            "id" => $this->id,
            "session" => $this->session,
            "annee" => $this->annee,
            "limite_abandon" => $this->limite_abandon,
            "plansCadres" => SessionPlanCadreResource::collection($this->plansCadres),
            "plansCours" => SessionPlanCoursResource::collection($this->plansCours)
        ];
    }

}
