<?php

namespace App\Http\Resources\EnseignantResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Ressource permettant d'exporter des enseignants en JSON
 * @author Jonathan Carrière
 */
class EnseignantResource extends JsonResource
{
    /**
     * Méthode permettant d'exporter des enseignants en JSON
     * @param Request $request Requête utilisée pour l'exportation
     * @return array Array contenant les enseignants sous le format JSON
     */
    public function toArray(Request $request): array
    {
        // Retourner les enseignants convertis sous le format JSON
        return [
            "id" => $this->id,
            "prenom" => $this->prenom,
            "nom" => $this->nom,
            "courriel" => $this->courriel,
            "bureau" => $this->bureau,
            "poste" => $this->poste,
            "plansCours" => EnseignantPlanCoursResource::collection($this->plansCours),
            "programmes" => $this->programmes
        ];
    }

}
