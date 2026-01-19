<?php

/**
 * @author Emeric Chauret
 */

namespace App\Http\Controllers\CampusControllers;

use App\Http\Controllers\BaseController;
use App\Http\Resources\CampusResources\CampusResource;
use App\Models\Campus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CampusController extends BaseController
{
    /**
     * Méthode qui retourne la liste des campus dans la bd sous format json.
     * @return JsonResponse la liste des campus dans la bd sous format json (JsonResponse)
     */
    public function index(): JsonResponse
    {
        return $this->sendResponse(CampusResource::collection(Campus::all()));
    }

    /**
     * Métode qui crée un campus dans la bd.
     * @param  Request  $request requête qui contient les données du campus à créer dans la bd (Request)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     */
    public function store(Request $request): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin');
        $this->validateCampus($request);
        Campus::create([
            'nom' => $request->json('nom')
        ]);
        return $this->sendResponse('', 201);
    }

    /**
     * Méthode qui retourne un campus dans la bd.
     * @param  string  $id l'identifiant du campus à récupérer dans la bd (string)
     * @return JsonResponse le campus récupéré dans la bd sous format json (JsonResponse)
     */
    public function show(string $id): JsonResponse
    {
        $campus = Campus::find($id);
        if($campus){
            return $this->sendResponse(CampusResource::make($campus));
        }
        return $this->sendError('Campus non trouvé');
    }

    /**
     * Méthode qui modifie un campus dans la bd.
     * @param  Request  $request requête qui contient les nouvelles données du campus à modifier dans la bd (Request)
     * @param  string  $id l'identifiant du campus à modifier dans la bd (string)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin');
        $this->validateCampus($request);
        $campus = Campus::find($id);
        if($campus){
            $campus->update([
                'nom' => $request->json('nom')
            ]);
            return $this->sendResponse('');
        }
        return $this->sendError('Campus non trouvé');
    }

    /**
     * Méthode qui supprime un campus dans la bd.
     * @param  string  $id l'identifiant du campus à supprimer dans la bd (string)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     */
    public function destroy(string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin');
        $campus = Campus::find($id);
        if($campus){
            $campus->delete();
            return $this->sendResponse('');
        }
        return $this->sendError('Campus non trouvé');
    }

    /**
     * Méthode pour valider les données entrées par l'utilisateur
     * dans le formulaire pour créer et modifier un campus.
     * @param  Request  $request requête qui contient les données à valider (Request)
     * @return array
     */
    private function validateCampus(Request $request): array {
        return $request->validate([
            'nom' => ['required', 'string']
        ]);
    }
}
