<?php

/**
 * @author Emeric Chauret
 */

namespace App\Http\Controllers\GabaritControllers;

use App\Http\Controllers\BaseController;
use App\Http\Resources\GabaritResources\GabaritResource;
use App\Models\Gabarit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class GabaritController extends BaseController
{
    /**
     * Méthode qui retourne la liste des gabarits dans la bd sous format json.
     * @return JsonResponse la liste des gabarits dans la bd sous format json (JsonResponse)
     */
    public function index(): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        return $this->sendResponse(GabaritResource::collection(Gabarit::all()->sortBy('nom')));
    }

    /**
     * Métode qui crée un gabarit dans la bd.
     * @param  Request  $request la requête qui contient les données du gabarit à créer dans la bd (Request)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     */
    public function store(Request $request): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        $this->validateGabarit($request);
        $gabarit = Gabarit::create([
            'nom' => $request->json('nom')
        ]);
        $gabarit->associer_sections($request->json('sections'));
        return $this->sendResponse('', 201);
    }

    /**
     * Méthode qui retourne un gabarit dans la bd.
     * @param  string  $id l'identifiant du gabarit à récupérer dans la bd (string)
     * @return JsonResponse le gabarit récupéré dans la bd sous format json (JsonResponse)
     */
    public function show(string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_authentifie');
        $gabarit = Gabarit::find($id);
        if($gabarit){
            return $this->sendResponse(GabaritResource::make($gabarit));
        }
        return $this->sendError('Gabarit non trouvé');
    }

    /**
     * Méthode qui modifie un gabarit dans la bd.
     * @param  Request  $request requête qui contient les nouvelles données du gabarit à modifier dans la bd (Request)
     * @param  string  $id l'identifiant du gabarit à modifier dans la bd (string)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        $this->validateGabarit($request);
        $gabarit = Gabarit::find($id);
        if($gabarit){
            $gabarit->update([
                'nom' => $request->json('nom')
            ]);
            $gabarit->associer_sections($request->json('sections'));
            return $this->sendResponse('');
        }
        return $this->sendError('Gabarit non trouvé');
    }

    /**
     * Méthode qui supprime un gabarit dans la bd.
     * @param  string  $id l'identifiant du gabarit à supprimer dans la bd (string)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     */
    public function destroy(string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        $gabarit = Gabarit::find($id);
        if($gabarit){
            $gabarit->delete();
            return $this->sendResponse('');
        }
        return $this->sendError('Gabarit non trouvé');
    }

    /**
     * Méthode pour valider les données entrées par l'utilisateur
     * dans le formulaire pour créer et modifier un gabarit.
     * @param  Request  $request requête qui contient les données à valider (Request)
     * @return array
     */
    private function validateGabarit(Request $request): array {
        return $request->validate([
            'nom' => ['required', 'string'],
            'sections' => ['present', 'array'],
            'sections.*.id' => ['required', 'exists:sections,id']
        ]);
    }
}
