<?php

namespace App\Http\Controllers\RoleController;

use App\Http\Controllers\BaseController;
use App\Http\Resources\RoleResources\RoleResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

/**
 * Contrôleur permettant d'effectuer la gestion des rôles
 * @author Jonathan Carrière
 */
class RoleController extends BaseController
{
    /**
     * Obtenir l'ensemble des rôles sous le format JSON
     * @return JsonResponse Ensemble des rôles en JSON
     */
    public function index(): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin');
        // Trier et retourner l'ensemble des rôles sous le format JSON
        return $this->sendResponse(RoleResource::collection(Role::all()->sortBy('id')), 201);
    }

}
