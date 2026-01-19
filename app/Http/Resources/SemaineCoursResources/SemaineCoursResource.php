<?php

namespace App\Http\Resources\SemaineCoursResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Ressource permettant d'exporter des semaines de cours en JSON
 * @author Jonathan Carrière
 */
class SemaineCoursResource extends JsonResource
{
    /**
     * Méthode permettant d'exporter des semaines de cours en JSON
     * @param Request $request Requête utilisée pour l'exportation
     * @return array Array contenant les semaines de cours sous le format JSON
     */
    public function toArray(Request $request): array
    {
        // Retourner les semaines de cours converties sous le format JSON
        return [
            "id"=>$this->id,
            "semaineDebut"=>$this->semaineDebut,
            "semaineFin"=>$this->semaineFin,
            "contenu"=>$this->contenu,
            "activites"=>$this->activites,
            "elementsCompetences"=>$this->elementsCompetences,
            "planCours"=>$this->planCours
        ];
    }

}
