<?php

namespace App\Http\Resources\RoleResources;

use App\Http\Resources\EnseignantResources\EnseignantPlanCoursResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Ressource permettant d'exporter des rôles en JSON
 * @author Jonathan Carrière
 */
class RoleResource extends JsonResource
{
    /**
     * Méthode permettant d'exporter des rôles en JSON
     * @param Request $request Requête utilisée pour l'exportation
     * @return array Array contenant les rôles sous le format JSON
     */
    public function toArray(Request $request): array
    {
        // Retourner les rôles convertis sous le format JSON
        return [
            "id" => $this->id,
            "nom" => $this->nom
        ];
    }
}
