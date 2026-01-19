<?php

namespace App\Http\Controllers\EnseignantController;

use App\Http\Controllers\BaseController;
use App\Http\Resources\EnseignantResources\EnseignantResource;
use App\Models\Enseignant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * Contrôleur permettant d'effectuer la gestion des enseignants
 * @author Jonathan Carrière
 */
class EnseignantController extends BaseController
{
    /**
     * Obtenir l'ensemble des enseignants sous le format JSON
     * @return JsonResponse Ensemble des enseignants en JSON
     */
    public function index(): JsonResponse
    {
        // Trier et retourner l'ensemble des enseignants sous le format JSON
        return $this->sendResponse(EnseignantResource::collection(Enseignant::all()->sortBy('nom')), 201);
    }

    /**
     * Entreposer un nouvel enseignant dans la base de données
     * @param Request $request Requête permettant d'entreposer l'enseignant
     * @return JsonResponse Réponse JSON contenant l'ensemble des enseignants
     */
    public function store(Request $request): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp_ou_coordonnateur');
        // Valider le nouvel enseignant
        $this->validateEnseignant($request);
        // Créer un enseignant via les données provenant du formulaire
        $enseignant = Enseignant::create([
            'prenom' => $request->prenom,
            'nom' => $request->nom,
            'courriel' => $request->courriel,
            'bureau' => $request->bureau,
            'poste' => $request->poste
        ]);
        // Associer la liste des programmes à un enseignant
        $enseignant->associerProgrammes($request->programmes);
        // Retourner la collection JSON contenant l'ensemble des enseignants
        return $this->sendResponse(EnseignantResource::collection(Enseignant::all()->sortBy('nom')), 201);
    }

    /**
     * Obtenir un enseignant spécifique selon son Id
     * @param string $id Id de l'enseignant qui sera affiché
     * @return JsonResponse Enseignant ayant l'Id spécifié en JSON
     */
    public function show(string $id): JsonResponse
    {
        // Obtenir l'enseignant de la base de données en utilisant son Id
        $enseignant = Enseignant::find($id);
        // Vérifier si l'enseignant ayant l'Id spécifiée existe
        if ($enseignant) {
            // Retourner l'enseignant ayant l'Id spécifié sous le format JSON
            return $this->sendResponse(new EnseignantResource($enseignant), 201);
        }
        // Si l'Id ne correspond pas à un enseignant existant, retourner une erreur
        return $this->sendError("L'enseignant spécifié n'existe pas");
    }

    /**
     * Mettre à jour un enseignant dans la base de données
     * @param Request $request Requête contenant l'enseignant modifié
     * @param string $id Id de l'enseignant qui doit être modifié
     * @return JsonResponse Réponse JSON contenant l'ensemble des enseignants
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp_ou_coordonnateur');
        // Obtenir l'enseignant de la base de données en utilisant son Id
        $enseignant = Enseignant::find($id);
        // Vérifier si l'enseignant ayant l'Id spécifiée existe
        if ($enseignant) {
            // Valider le nouvel enseignant
            $this->validateEnseignant($request);
            // Mettre à jour l'enseignant via les données provenant du formulaire
            $enseignant->update([
                'prenom' => $request->prenom,
                'nom' => $request->nom,
                'courriel' => $request->courriel,
                'bureau' => $request->bureau,
                'poste' => $request->poste
            ]);
            // Associer la liste des programmes à un enseignant
            $enseignant->associerProgrammes($request->programmes);
            // Retourner la collection JSON contenant l'ensemble des enseignants
            return $this->sendResponse(EnseignantResource::collection(Enseignant::all()->sortBy('nom')), 201);
        }
        // Si l'Id ne correspond pas à un enseignant existant, retourner une erreur
        return $this->sendError("L'enseignant spécifié n'existe pas");
    }

    /**
     * Supprimer un enseignant dans la base de données
     * @param string $id Id de l'enseignant qui sera supprimé
     * @return JsonResponse Réponse JSON contenant l'ensemble des enseignants
     */
    public function destroy(string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp_ou_coordonnateur');
        // Obtenir l'enseignant de la base de données en utilisant son Id
        $enseignant = Enseignant::find($id);
        // Vérifier si l'enseignant ayant l'Id spécifiée existe
        if ($enseignant) {
            // Supprimer l'enseignant de la base de données
            Enseignant::destroy($id);
            // Retourner la collection JSON contenant l'ensemble des enseignants
            return $this->sendResponse(EnseignantResource::collection(Enseignant::all()->sortBy('nom')), 201);
        }
        // Si l'Id ne correspond pas à un enseignant existant, retourner une erreur
        return $this->sendError("L'enseignant spécifié n'existe pas");
    }

    /**
     * Valider les propriétés d'un enseignant provenant d'un formulaire
     * @param Request $request Requête contenant l'enseignant
     * @return array Array contenant la validation des propriétés
     */
    private function validateEnseignant(Request $request): array {
        // Retourner la validation de la requête
        return $request->validate([
            'prenom' => ['required', 'string', 'min:2', 'max:50'],
            'nom' => ['required', 'string', 'min:2', 'max:50'],
            'courriel' => ['required', 'string', 'email', 'regex:/^.+@cegepoutaouais\.qc\.ca$/', 'max:50'],
            'bureau' => ['required', 'string', 'regex:/^\d\.\d{3}$/'],
            'poste' => ['integer', 'nullable'],
            'programmes' => ['array'],
            'programmes.*.id' => ['required', 'integer', 'exists:programmes,id']
        ]);
    }

}
