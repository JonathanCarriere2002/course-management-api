<?php

namespace App\Http\Resources\UserResources;

use App\Http\Resources\ProgrammeResources\ProgrammeResource;
use App\Http\Resources\RoleResources\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Ressource permettant d'exporter des utilisateurs en JSON
 * @authors Jonathan Carrière  et Emeric Chauret
 */
class UserResource extends JsonResource
{
    /**
     * Méthode permettant d'exporter des utilisateurs en JSON
     * @param Request $request Requête utilisée pour l'exportation
     * @return array Array contenant les utilisateurs sous le format JSON
     */
    public function toArray(Request $request): array
    {
        // Retourner les utilisateurs convertis sous le format JSON
        return [
            "id" => $this->id,
            "nom" => $this->name,
            "prenom" => $this->firstname,
            "courriel" => $this->email,
            "courriel_verifie" => $this->email_verified_at,
            "role" => $this->role,
            "roleObjet" => new RoleResource($this->roleUtilisateur),
            "bureau" => $this->bureau,
            "poste" => $this->poste,
            "programmes" => ProgrammeResource::collection($this->programmes),
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }

}
