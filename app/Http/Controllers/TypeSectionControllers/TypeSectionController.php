<?php

/**
 * @author Emeric Chauret
 */

namespace App\Http\Controllers\TypeSectionControllers;

use App\Http\Controllers\BaseController;
use App\Http\Resources\SectionResources\TypeSectionResource;
use App\Models\TypeSection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TypeSectionController extends BaseController
{
    /**
     * Méthode qui retourne la liste des types de section dans la bd sous format json.
     * @return JsonResponse la liste des types de section dans la bd sous format json (JsonResponse)
     */
    public function index(): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        return $this->sendResponse(TypeSectionResource::collection(TypeSection::all()->sortBy('type')));
    }

}
