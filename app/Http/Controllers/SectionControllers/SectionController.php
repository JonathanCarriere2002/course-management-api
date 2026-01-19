<?php

/**
 * @author Emeric Chauret
 */

namespace App\Http\Controllers\SectionControllers;

use App\Http\Controllers\BaseController;
use App\Http\Resources\SectionResources\SectionResource;
use App\Models\Section;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SectionController extends BaseController
{
    /**
     * Méthode qui retourne la liste des sections dans la bd sous format json.
     * @return JsonResponse la liste des sections dans la bd sous format json (JsonResponse)
     */
    public function index(): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        return $this->sendResponse(SectionResource::collection(Section::all()->sortBy('titre')));
    }

    /**
     * Métode qui crée une section dans la bd.
     * @param  Request  $request larequête qui contient les données de la section à créer dans la bd (Request)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     */
    public function store(Request $request): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        $this->validateSection($request);
        $section = Section::create([
           'titre' => $request->json('titre'),
           'aide' => $request->json('aide'),
           'obligatoire' => $request->json('obligatoire')
        ]);
        $section->associer_type_section($request->json('type_section_id'));
        return $this->sendResponse('', 201);
    }

    /**
     * Méthode qui retourne une section dans la bd.
     * @param  string  $id l'identifiant de la section à récupérer dans la bd (string)
     * @return JsonResponse la section récupérée dans la bd sous format json (JsonResponse)
     */
    public function show(string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        $section = Section::find($id);
        if($section){
            return $this->sendResponse(SectionResource::make($section));
        }
        return $this->sendError('Section non trouvée');
    }

    /**
     * Méthode qui modifie une section dans la bd.
     * @param  Request  $request la requête qui contient les nouvelles données de la section à modifier dans la bd (Request)
     * @param  string  $id l'identifiant de la section à modifier dans la bd (string)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        $this->validateSection($request);
        $section = Section::find($id);
        if($section){
            $section->update([
                'titre' => $request->json('titre'),
                'aide' => $request->json('aide'),
                'obligatoire' => $request->json('obligatoire')
            ]);
            $section->associer_type_section($request->json('type_section_id'));
            return $this->sendResponse('');
        }
        return $this->sendError('Section non trouvée');
    }

    /**
     * Méthode qui supprime une section dans la bd.
     * @param  string  $id l'identifiant de la section à supprimer dans la bd (string)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     */
    public function destroy(string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        $section = Section::find($id);
        if($section){
            $section->delete();
            return $this->sendResponse('');
        }
        return $this->sendError('Section non trouvée');
    }

    /**
     * Méthode pour valider les données entrées par l'utilisateur
     * dans le formulaire pour créer et modifier une section.
     * @param  Request  $request requête qui contient les données à valider (Request)
     * @return array
     */
    private function validateSection(Request $request): array {
        return $request->validate([
           'titre' => ['required', 'string'],
           'aide' => ['nullable', 'string'],
           'obligatoire' => ['required', 'boolean'],
           'type_section_id' => ['required', 'exists:type_sections,id']
        ]);
    }
}
