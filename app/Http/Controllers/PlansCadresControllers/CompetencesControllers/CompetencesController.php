<?php
/* @author lebel */
namespace App\Http\Controllers\PlansCadresControllers\CompetencesControllers;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlansCadresResources\CompetencesResources\CompetencesResource;
use App\Http\Resources\PlansCadresResources\CompetencesResources\CriteresPerformanceResource;
use App\Models\Competence;
use App\Models\CriterePerformance;
use App\Models\ElementCompetence;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CompetencesController extends BaseController
{
    // Constructeur qui appel le policy de compétence pour gérer les autorisations
    public function __construct()
    {
        //$this->authorizeResource(Competence::class, 'competence');
    }


    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        // Vérifier si le user est autorisé
        Gate::authorize('est_authentifie');

        return $this->sendResponse(CompetencesResource::collection(Competence::all()->sortBy('code')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        // Vérifier si le user est autorisé
        Gate::authorize('est_admin_ou_cp_ou_srdp');

        // Valider la comp
        $this->validateCompetence($request);

        // Creer la comp avec les donnees dans le formulaire
        $competence = Competence::create([
            "code" => $request->code,
            "enonce" => $request->enonce,
            "annee_devis" => $request->annee_devis,
            "pages_devis" => $request->pages_devis,
            "contexte" => $request->contexte,
            "programme_id" => $request->programme_id
        ]);
        /**
         * Les elements de competence et les criteres de performance sont tous gérés dans leur controllers respectif.
         * Seulement les liaisons sont faites ici afin de ne pas surcharger l'api de requêtes lorsqu'on "joue" avec le
         * drag and drop.
         */

        // Verifier si liste d'elements est vide et null
        if(isset($request->elementsCompetences)) {
            // Parcourir les elements de comp de la liste
            foreach ($request->elementsCompetences as $elementComp){
                // Associer les éléments de compétence à la compétence
                // J'aurais voulu faire la création des éléments de compétence ici, mais c'est une grande adaptation
                // pour mon code et mes modals de création et modification. Je pense prioriser autres choses avant.
                ElementCompetence::find($elementComp['id'])->associer_competence($competence->id);
                // Vérifier si liste de critères vide et null
                if(count($elementComp['criteresPerformance']) > 0) {
                    // Parcourir les critères de performance de chacun des éléments de compétence
                    foreach ($elementComp['criteresPerformance'] as $critere_perfo) {
                        // Associer les critères de performance à leur élément de compétence respectif
                        // TODO Même chose pour les critère de performance
                        CriterePerformance::find($critere_perfo['id'])->associer_element_competences($elementComp['id']);
                    }
                }
            }
        }
        // Associer le programme a la competence avec son Id
        $competence->associer_programme($request->programme_id);

        // Retouner les competences
        return $this->sendResponse(CompetencesResource::collection(Competence::all()->sortBy('code')));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        // Vérifier si le user est autorisé
        Gate::authorize('est_authentifie');

        // Recuperer la comp de la BD
        $competence = Competence::find($id);

        // Verifier si la comp existe
        if($competence){
            // Renvoyer la competence associee au id en param
            return $this->sendResponse(CompetencesResource::make($competence));
        }
        return $this->sendError('Competence non trouvée.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Vérifier si le user est autorisé
        Gate::authorize('est_admin_ou_cp_ou_srdp');

        // Valider la comp avec validation serveur
        $this->validateCompetence($request);

        // Recuperer la comp de la BD
        $competence = Competence::find($id);

        // Vérifier si la comp ayant l'Id spécifiée existe
        if($competence){
            // Mettre à jour la comp
            $competence->update([
                "code" => $request->code,
                "enonce" => $request->enonce,
                "annee_devis" => $request->annee_devis,
                "pages_devis" => $request->pages_devis,
                "contexte" => $request->contexte,
                "programme_id" => $request->programme_id
            ]);
            /**
             * Les elements de competence et les criteres de performance sont tous gérés dans leur controllers respectif.
             * Seulement les liaisons sont faites ici afin de ne pas surcharger l'api de requêtes lorsqu'on "joue" avec le
             * drag and drop.
             */

            // Verifier si liste d'elements est vide et null
            if(isset($request->elementsCompetences)) {
                // Parcourir les elements de comp de la liste
                foreach ($request->elementsCompetences as $elementComp){
                    // Associer les elements de competence a la compétence
                    ElementCompetence::find($elementComp['id'])->associer_competence($competence->id);
                    // Verifier si liste de criteres vide et null
                    if(count($elementComp['criteresPerformance']) > 0) {
                        // Parcourir les criteres de perfo de chacun des elements de comp
                        foreach ($elementComp['criteresPerformance'] as $critere_perfo) {
                            // Associer les criteres de perfo a leur element de comp respectif
                            CriterePerformance::find($critere_perfo['id'])->associer_element_competences($elementComp['id']);
                        }
                    }
                }
            }
            // Associer le programme a la competence avec son Id
            $competence->associer_programme($request->programme_id);

            // Retouner les competences
            return $this->sendResponse(CompetencesResource::collection(Competence::all()->sortBy('code')));
        }
        // Retouner une erreur sinon
        return $this->sendError('Competence non trouvée.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        // Vérifier si le user est autorisé
        Gate::authorize('est_admin_ou_cp_ou_srdp');

        // Recuperer la comp de la BD
        $competence = Competence::find($id);

        // Vérifier si la comp ayant l'Id spécifiée existe
        if($competence){

            // Supprimer la competence de la BD
            $competence->delete();

            // Retouner les competences
            return $this->sendResponse(CompetencesResource::collection(Competence::all()->sortBy('code')));
        }
        // Retouner une erreur sinon
        return $this->sendError('Competence non trouvée.');
    }

    /**
     * Méthode pour la validation des compétences
     * @param Request $request
     * @return array
     */
    private function validateCompetence(Request $request){
        //Validation côté serveur
        return $request->validate([
            'code' => array('required', 'string', 'min:4'),
            'enonce' => 'required|string|min:5',
            'annee_devis' => 'required|numeric|between:1975,3000',
            'pages_devis' => array('required', 'string', 'regex:/^\d+(?:-\d+)*$/i'),
            'contexte' => 'required|string|min:5',
            'elements_competence' => 'array',
            'elements_competence.*.numero' => array('required', 'string', 'regex:/^[1-9]\d*\.?$/i'),
            'elements_competence.*.texte' => 'required|string|min:5',
            'elements_competence.*.criteresPerformance' => 'array',
            'elements_competence.*.criteresPerformance.*.numero' => array('string', 'regex:/^(\b[1-9]\d*(\.[1-9]+)\b)?$/i'),
            'elements_competence.*.criteresPerformance.*.texte' => 'required|string|min:5'
        ]);
    }
}
