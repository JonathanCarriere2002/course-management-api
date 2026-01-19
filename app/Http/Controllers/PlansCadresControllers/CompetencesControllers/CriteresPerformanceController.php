<?php
/* @author lebel */
namespace App\Http\Controllers\PlansCadresControllers\CompetencesControllers;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PlansCadresResources\CompetencesResources\CriteresPerformanceResource;
use App\Models\CriterePerformance;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CriteresPerformanceController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // Vérifier si le user est authentifié
        Gate::authorize('est_authentifie');

        return $this->sendResponse(CriteresPerformanceResource::collection(CriterePerformance::all()->sortBy('numero')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        // Vérifier si le user est autorisé
        Gate::authorize('est_admin_ou_cp_ou_srdp');

        // Valider les donnees recues
        $this->validateCriterePerformance($request);

        // Creer l'element de comp
        $criterePerfo = CriterePerformance::create([
            'numero' => $request->numero,
            'texte' => $request->texte,
            'isExpanded' => false,
        ]);
        // L'association est faite dans le controlleur de competence -> deuxieme loop

        // Retourner le dernier critere cree
        return $this->sendResponse(CriteresPerformanceResource::make(CriterePerformance::all()->last()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        // Vérifier si le user est authentifié
        Gate::authorize('est_authentifie');

        // Recuperer le critere de perfo de la BD
        $criterePerfo = CriterePerformance::find($id);

        if($criterePerfo){
            // Renvoyer l'element de comp associee au id en param
            return $this->sendResponse(CriteresPerformanceResource::make($criterePerfo));
        }
        return $this->sendError('Critère de performance non trouvé.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Vérifier si le user est autorisé
        Gate::authorize('est_admin_ou_cp_ou_srdp');

        // Valider les champs du critere de perfo
        $this->validateCriterePerformance($request);

        // Recuperer le critere de perfo de la BD
        $criterePerfo = CriterePerformance::find($id);

        if($criterePerfo){

            // Update le critere ayant l'Id specifie
            $criterePerfo->update([
                'numero' => $request->numero,
                'texte' => $request->texte,
                'isExpanded' => false
            ]);
            // L'association est faite dans le controlleur de competence

            // Retourner le dernier critere cree
            return $this->sendResponse($criterePerfo);
        }
        return $this->sendError('Critère de performance non trouvé.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        // Vérifier si le user est autorisé
        Gate::authorize('est_admin_ou_cp_ou_srdp');

        // Recuperer le critere de perfo de la BD
        $criterePerfo = CriterePerformance::find($id);

        if($criterePerfo){

            // Update le critere ayant l'Id specifie
            $criterePerfo->delete();

            // Renvoyer les criteres de perfo
            return $this->sendResponse(CriteresPerformanceResource::collection(CriterePerformance::all()->sortBy('numero')));
        }
        return $this->sendError('Critère de performance non trouvé.');
    }

    private function validateCriterePerformance(Request $request){
        //Validation côté serveur
        return $request->validate([
            'numero' => 'nullable|regex:/^(\b[1-9]\d*(\.[1-9]+)\b)?$/i',
            'texte' => 'required|string'
        ]);
    }
}
