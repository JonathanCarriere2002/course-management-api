<?php
/* @author lebel */
namespace App\Http\Controllers\PlansCadresControllers\CompetencesControllers;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PlansCadresResources\CompetencesResources\CriteresPerformanceResource;
use App\Http\Resources\PlansCadresResources\CompetencesResources\ElementsCompetenceResource;
use App\Models\CriterePerformance;
use App\Models\ElementCompetence;
use Illuminate\Http\Request;
use \Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class ElementsCompetenceController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        // Vérifier si le user est authentifié
        Gate::authorize('est_authentifie');

        return $this->sendResponse(ElementsCompetenceResource::collection(ElementCompetence::all()->sortBy('numero')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        // Vérifier si le user est autorisé
        Gate::authorize('est_admin_ou_cp_ou_srdp');

        // Valider les donnees
        $this->validateElementCompetence($request);

        // Creer l'objet element comp
        $elementCompetence = ElementCompetence::create([
            'numero' => $request->numero,
            'texte' => $request->texte,
            'isExpanded' => false,
        ]);
        // L'association est faite dans le controlleur de competence

        // Retourner le dernier element de comp creer
        return $this->sendResponse(ElementsCompetenceResource::make(ElementCompetence::all()->last()));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        // Vérifier si le user est authentifié
        Gate::authorize('est_authentifie');

        // Recuperer l'element de comp de la BD
        $elementComp = ElementCompetence::find($id);

        if($elementComp){
            // Renvoyer l'element de comp associee au id en param
            return $this->sendResponse(ElementsCompetenceResource::make($elementComp));
        }
        return $this->sendError('Élément de compténce non trouvé.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Vérifier si le user est autorisé
        Gate::authorize('est_admin_ou_cp_ou_srdp');

        // Valider l'element de comp avec validation serveur
        $this->validateElementCompetence($request);

        // Recuperer  l'element de comp de la BD
        $elementComp = ElementCompetence::find($id);

        // Vérifier si l'element de comp ayant l'Id spécifiée existe
        if($elementComp){
            // Mettre à jour l'element de comp
            $elementComp->update([
                'numero' => $request->numero,
                'texte' => $request->texte,
                'isExpanded' => false,
            ]);
            // L'association est faite dans le controlleur de competence

            // Retourner le dernier element de comp creer
            return $this->sendResponse($elementComp);
        }
        return $this->sendError('Élément de competénce non trouvé.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        // Vérifier si le user est autorisé
        Gate::authorize('est_admin_ou_cp_ou_srdp');

        // Recuperer  l'element de comp de la BD
        $elementComp = ElementCompetence::find($id);

        // Vérifier si l'element de comp ayant l'Id spécifiée existe
        if($elementComp){
            // Supprimer l'element de competence
            $elementComp->delete();

            // Retouner les elements de comp
            return $this->sendResponse(ElementsCompetenceResource::collection(ElementCompetence::all()->sortBy('code')));
        }
        // Retouner une erreur sinon
        return $this->sendError('Élément de compténce non trouvé.');
    }

    /**
     * Méthode pour la validation des plans cadres.
     * La base est prise du projet final de PHP de Jacob de H23
     * @param Request $request
     * @return array
     */
    private function validateElementCompetence(Request $request){
        //Validation côté serveur
        return $request->validate([
            'numero' => array('required', 'string', 'regex:/^[1-9]\d*\.?$/i'),
            'texte' => 'required|string',
        ]);

    }
}
