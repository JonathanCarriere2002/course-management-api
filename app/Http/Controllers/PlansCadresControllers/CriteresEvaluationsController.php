<?php

/**
 * @author Jacob Beauregard-Tousignant
 */


namespace App\Http\Controllers\PlansCadresControllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlansCadresResources\CriteresEvaluation\CritereEvaluationElementCompetenceResource;
use App\Http\Resources\PlansCadresResources\CriteresEvaluation\CriteresEvaluationsResource;
use App\Models\CritereEvaluation;
use App\Models\ElementCompetence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CriteresEvaluationsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        Gate::authorize('est_authentifie');
        return $this->sendResponse(CriteresEvaluationsResource::collection(CritereEvaluation::all()->sortBy('plan_cadre_id')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('est_authentifie');
        $this->validateCriteresEvaluation($request);
        $critere = CritereEvaluation::create([
            'enonce'=>$request->enonce,
            'ponderation'=>$request->ponderation
        ]);

        //Assigner les éléments de compétence
        if(isset($request->elementsCompetence)){
            //Assigner les éléments de compétence
            foreach ($request->elementsCompetence as $elementsCompetenceIndi){
                $critere->ajouterElementCompetence($elementsCompetenceIndi['id']);
            }
        }

        return $this->sendResponse(new CriteresEvaluationsResource($critere));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('est_authentifie');
        //Aller chercher le critère d'évaluation à retourner
        $critereEval = CritereEvaluation::find($id);

        //Vérifier si on a bien trouvé un critère
        if(isset($critereEval)){
            return $this->sendResponse(new CriteresEvaluationsResource($critereEval));
        }

        //Sinon retourner une erreur
        else{
            return $this->sendError('Plan cadre non trouvé');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('est_authentifie');
        // Obtenir le critère d'évaluation de la BD
        $critereEvaluation = CritereEvaluation::find($id);
        // Vérifier si un critère a été trouvé
        if (isset($critereEvaluation)) {
            // Valider la nouvelle version du critère
            $this->validateCriteresEvaluation($request);
            // Mettre à jour le critère de la bd
            $critereEvaluation->update([
                'enonce'=>$request->enonce,
                'ponderation'=>$request->ponderation
            ]);



            //Dissocier tous les éléments de compétence
            foreach ($critereEvaluation->elements_competences as $elements_competence) {
                $critereEvaluation->enleverElementCompetence($elements_competence->pivot->id_element_compe);
            }

            //Assigner les éléments de compétence
            if(isset($request->elementsCompetence)){
                //Assigner les éléments de compétence
                foreach ($request->elementsCompetence as $elementCompetence){
                    $critereEvaluation->ajouterElementCompetence($elementCompetence['id']);

                }
            }
            // Retourner tous les critères sous format JSON
            return $this->sendResponse(CriteresEvaluationsResource::make($critereEvaluation), 201);
        }
        // Si aucun critère n'a été trouvé avec l'id, retourner une erreur
        return $this->sendError("Le critère d'évaluation n'a pas été trouvé");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('est_authentifie');
        //Aller chercher le critère d'évaluation à supprimer
        $critereEvaluation = CritereEvaluation::find($id);
        //Vérifier si le critère a été trouvé
        if($critereEvaluation){
            //Supprimer le critère de la BD
            $critereEvaluation->delete();
            //Retourner la liste de tous les critères d'évaluation
            return $this->sendResponse(CriteresEvaluationsResource::collection(CritereEvaluation::all()->sortBy('plan_cadre_id')));
        }
        //Si le plan cadre n'a pas été trouvé, retourner une erreur
        else{
            return $this->sendError('Plan cadre non trouvé');
        }
    }


    /**
     * Méthode de validations pour les critères d'évaluations
     * @param Request $request
     * @return array
     */
    private function validateCriteresEvaluation(Request $request){
        return $request->validate([
            'enonce' => 'required',
            'ponderation' => 'required|numeric|between:0,100',
        ]);
    }
}
