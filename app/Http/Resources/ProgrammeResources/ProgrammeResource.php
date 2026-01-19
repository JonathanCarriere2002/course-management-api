<?php

namespace App\Http\Resources\ProgrammeResources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Ressource permettant d'exporter des programmes en JSON
 * @author Samir El Haddaji
 */
class ProgrammeResource extends JsonResource
{
    /**
     * Méthode permettant d'exporter des programmes en JSON
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        // Retourner les programmes convertis sous le format JSON
        return [
            "id"=>$this->id,
            "code"=>$this->code,
            "titre"=>$this->titre,
            "competences"=>$this->competences
        ];
    }
}
