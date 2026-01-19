<?php

namespace App\Http\Controllers\SessionController;

use App\Http\Controllers\BaseController;
use App\Http\Resources\SessionResources\SessionResource;
use App\Models\Session;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * Contrôleur permettant d'effectuer la gestion des sessions
 * @author Jonathan Carrière
 */
class SessionController extends BaseController
{
    /**
     * Obtenir l'ensemble des sessions sous le format JSON
     * @return JsonResponse Ensemble des sessions en JSON
     */
    public function index(): JsonResponse
    {
        // Trier et retourner l'ensemble des sessions sous le format JSON
        return $this->sendResponse(SessionResource::collection(Session::all()->sortBy('session')->sortBy('annee')), 201);
    }

    /**
     * Entreposer une nouvelle session dans la base de données
     * @param Request $request Requête permettant d'entreposer une session
     * @return JsonResponse Réponse JSON contenant l'ensemble des sessions
     */
    public function store(Request $request): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        // Valider la nouvelle session
        $this->validateSession($request);
        // Créer une session via les données provenant du formulaire
        $session = Session::create([
            'session' => $request->input('session'),
            'annee' => $request->annee,
            'limite_abandon' => $request->limite_abandon
        ]);
        // Retourner la collection JSON contenant l'ensemble des sessions
        return $this->sendResponse(SessionResource::collection(Session::all()->sortBy('annee')), 201);
    }

    /**
     * Obtenir une session spécifique selon son Id
     * @param string $id Id de la session qui sera affichée
     * @return JsonResponse Session ayant l'Id spécifié en JSON
     */
    public function show(string $id): JsonResponse
    {
        // Obtenir la session de la base de données en utilisant son Id
        $session = Session::find($id);
        // Vérifier si la session ayant l'Id spécifiée existe
        if ($session) {
            // Retourner la session ayant l'Id spécifié sous le format JSON
            return $this->sendResponse(new SessionResource($session), 201);
        }
        // Si l'Id ne correspond pas à une session existante, retourner une erreur
        return $this->sendError("La session spécifiée n'existe pas");
    }

    /**
     * Mettre à jour une session dans la base de données
     * @param Request $request Requête contenant la session modifiée
     * @param string $id Id de la session qui doit être modifiée
     * @return JsonResponse Réponse JSON contenant l'ensemble des sessions
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        // Obtenir la session de la base de données en utilisant son Id
        $session = Session::find($id);
        // Vérifier si la session ayant l'Id spécifiée existe
        if ($session) {
            // Valider la session modifiée
            $this->validateSession($request);
            // Mettre à jour la session via les données provenant du formulaire
            $session->update([
                'session' => $request->input('session'),
                'annee' => $request->annee,
                'limite_abandon' => $request->limite_abandon
            ]);
            // Retourner la collection JSON contenant l'ensemble des sessions
            return $this->sendResponse(SessionResource::collection(Session::all()->sortBy('annee')), 201);
        }
        // Si l'Id ne correspond pas à une session existante, retourner une erreur
        return $this->sendError("La session spécifiée n'existe pas");
    }

    /**
     * Supprimer une session dans la base de données
     * @param string $id Id de la session qui sera supprimée
     * @return JsonResponse Réponse JSON contenant l'ensemble des sessions
     */
    public function destroy(string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        // Obtenir la session de la base de données en utilisant son Id
        $session = Session::find($id);
        // Vérifier si la session ayant l'Id spécifiée existe
        if ($session) {
            // Supprimer la session de la base de données
            Session::destroy($id);
            // Retourner la collection JSON contenant l'ensemble des sessions
            return $this->sendResponse(SessionResource::collection(Session::all()->sortBy('annee')), 201);
        }
        // Si l'Id ne correspond pas à une session existante, retourner une erreur
        return $this->sendError("La session spécifiée n'existe pas");
    }

    /**
     * Valider les propriétés d'une session provenant d'un formulaire
     * @param Request $request Requête contenant la session
     * @return array Array contenant la validation des propriétés
     */
    private function validateSession(Request $request): array {
        // Retourner la validation de la requête
        return $request->validate([
            'session' => ['required', 'string', 'min:2', 'max:50', 'regex:/^(Automne|Hiver|Été)$/'],
            'annee' => ['required', 'integer', 'between:1967,2099'],
            'limite_abandon' => ['required', 'date']
        ]);
    }

}
