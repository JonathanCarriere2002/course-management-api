<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\BaseController;
use App\Http\Resources\UserResources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

/**
 * Contrôleur permettant d'effectuer la gestion des utilisateurs
 * @author Jonathan Carrière
 * @author Emeric Chauret
 */
class UserController extends BaseController
{
    /**
     * Obtenir l'ensemble des utilisateurs sous le format JSON
     * @return JsonResponse Ensemble des utilisateurs en JSON
     * @author Jonathan Carrière
     */
    public function index(): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin');
        // Trier et retourner l'ensemble des utilisateurs sous le format JSON
        return $this->sendResponse(UserResource::collection(User::all()->sortBy('name')), 201);
    }

    /**
     * Entreposer un nouvel utilisateur dans la base de données
     * @param Request $request Requête permettant d'entreposer l'utilisateur
     * @return JsonResponse Réponse JSON contenant l'ensemble des utilisateurs
     * @author Jonathan Carrière
     * @author Emeric Chauret
     */
    public function store(Request $request): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin');
        // Valider le nouvel utilisateur
        $this->validateUtilisateur($request);
        $request->validate([
            'mot_de_passe' => ['required', 'string', 'min:8', 'confirmed'],
            'mot_de_passe_confirmation' => ['required', 'string', 'min:8']
        ]);
        if(in_array($request->json('role'), [4,5])){
            $request->validate([
                'bureau' => ['required', 'string', 'regex:/^\d\.\d{3}$/'],
                'poste' => ['integer', 'nullable'],
                'programmes' => ['required', 'array'],
                'programmes.*.id' => ['required', 'integer', 'exists:programmes,id']
            ]);
        }
        // Créer un utilisateur via les données provenant du formulaire
        $utilisateur = User::create([
            'name' => $request->json('nom'),
            'firstname' => $request->json('prenom'),
            'email' => $request->json('courriel'),
            'email_verified_at' => now(),
            'password' => $request->json('mot_de_passe'),
            'role' => $request->json('role'),
            'bureau' => in_array($request->json('role'), [4,5]) ? $request->json('bureau') : null,
            'poste' => in_array($request->json('role'), [4,5]) ? $request->json('poste') : null
        ]);
        // associer les programmes à l'utilisateur
        $utilisateur->associer_programmes(in_array($request->json('role'), [4,5]) ? $request->json('programmes') : []);
        // Retourner la collection JSON contenant l'ensemble des utilisateurs
        return $this->sendResponse(UserResource::collection(User::all()->sortBy('name')), 201);
    }

    /**
     * Obtenir un utilisateur spécifique selon son Id
     * @param string $id Id de l'utilisateur qui sera affiché
     * @return JsonResponse Utilisateur ayant l'Id spécifié en JSON
     * @author Jonathan Carrière
     */
    public function show(string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin');
        // Obtenir l'utilisateur de la base de données en utilisant son Id
        $utilisateur = User::find($id);
        // Vérifier si l'utilisateur ayant l'Id spécifiée existe
        if ($utilisateur) {
            // Retourner l'utilisateur ayant l'Id spécifié sous le format JSON
            return $this->sendResponse(new UserResource($utilisateur), 201);
        }
        // Si l'Id ne correspond pas à un utilisateur existant, retourner une erreur
        return $this->sendError("L'utilisateur spécifié n'existe pas");
    }

    /**
     * Mettre à jour un utilisateur dans la base de données
     * @param Request $request Requête contenant l'utilisateur modifié
     * @param string $id Id de l'utilisateur qui doit être modifié
     * @return JsonResponse Réponse JSON contenant l'ensemble des utilisateurs
     * @author Jonathan Carrière
     * @author Emeric Chauret
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin');
        // Obtenir l'utilisateur de la base de données en utilisant son Id
        $utilisateur = User::find($id);
        // Vérifier si l'utilisateur ayant l'Id spécifiée existe
        if ($utilisateur) {
            // Valider le nouvel utilisateur
            $this->validateUtilisateur($request, $utilisateur);
            $request->validate([
                'mot_de_passe' => ['nullable', 'string', 'min:8', 'confirmed'],
                'mot_de_passe_confirmation' => ['nullable', 'string', 'min:8']
            ]);
            if(in_array($request->json('role'), [4,5])){
                $request->validate([
                    'bureau' => ['required', 'string', 'regex:/^\d\.\d{3}$/'],
                    'poste' => ['integer', 'nullable'],
                    'programmes' => ['required', 'array'],
                    'programmes.*.id' => ['required', 'integer', 'exists:programmes,id']
                ]);
            }
            // Mettre à jour l'utilisateur via les données provenant du formulaire
            $utilisateur->update([
                'name' => $request->json('nom'),
                'firstname' => $request->json('prenom'),
                'email' => $request->json('courriel'),
                'email_verified_at' => now(),
                'password' => $request->json('mot_de_passe') == null ? $utilisateur->password : $request->mot_de_passe,
                'role' => $request->json('role'),
                'bureau' => in_array($request->json('role'), [4,5]) ? $request->json('bureau') : null,
                'poste' => in_array($request->json('role'), [4,5]) ? $request->json('poste') : null
            ]);
            // associer les programmes à l'utilisateur
            $utilisateur->associer_programmes(in_array($request->json('role'), [4,5]) ? $request->json('programmes') : []);
            // Retourner la collection JSON contenant l'ensemble des utilisateurs
            return $this->sendResponse(UserResource::collection(User::all()->sortBy('name')), 201);
        }
        // Si l'Id ne correspond pas à un utilisateur existant, retourner une erreur
        return $this->sendError("L'utilisateur spécifié n'existe pas");
    }

    /**
     * Supprimer un utilisateur dans la base de données
     * @param string $id Id de l'utilisateur qui sera supprimé
     * @return JsonResponse Réponse JSON contenant l'ensemble des utilisateurs
     * @author Jonathan Carrière
     */
    public function destroy(string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin');
        // Obtenir l'utilisateur de la base de données en utilisant son Id
        $utilisateur = User::find($id);
        // Vérifier si l'utilisateur ayant l'Id spécifiée existe
        if ($utilisateur) {
            // Supprimer l'utilisateur de la base de données
            User::destroy($id);
            // Retourner la collection JSON contenant l'ensemble des utilisateurs
            return $this->sendResponse(UserResource::collection(User::all()->sortBy('name')), 201);
        }
        // Si l'Id ne correspond pas à un utilisateur existant, retourner une erreur
        return $this->sendError("L'utilisateur spécifié n'existe pas");
    }

    /**
     * Valider les propriétés d'un utilisateur provenant d'un formulaire
     * @param Request $request Requête contenant l'utilisateur
     * @param User|null $utilisateur Utilisateur qui sera modifié via la requête. Ce paramètre est uniquement présent
     * lors de la modification afin de prévenir que l'obligation de modifier l'adresse courriel de l'utilisateur
     * Source (ligne 131) : https://laravel.com/docs/10.x/validation#rule-unique
     * @return array Array contenant la validation des propriétés
     * @author Jonathan Carrière
     */
    private function validateUtilisateur(Request $request, User $utilisateur = null): array {
        // Retourner la validation de la requête
        return $request->validate([
            'nom' => ['required', 'string', 'min:2', 'max:50'],
            'prenom' => ['required', 'string', 'min:2', 'max:50'],
            'courriel' => ['required', 'string', 'email', 'regex:/^.+@cegepoutaouais\.qc\.ca$/', 'max:50', Rule::unique('users', 'email')->ignore($utilisateur)],
            'role' => ['required', 'integer', 'exists:roles,id'],
        ]);
    }

}
