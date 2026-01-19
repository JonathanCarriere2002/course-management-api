<?php
/**
 * @author Jacob Beauregard-Tousignant
 */

namespace App\Http\Controllers\PlansCadresControllers;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PlansCadresResources\PlansCadres\CompetencePlanCadreResource;
use App\Http\Resources\PlansCadresResources\PlansCadres\PlanCadreAfficherTitreResource;
use App\Http\Resources\PlansCadresResources\PlansCadres\PlansCadresResource;
use App\Models\Competence;
use App\Models\CritereEvaluation;
use App\Models\PlanCadre;
use App\Models\Programme;
use App\Models\Section;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use function Laravel\Prompts\error;

class PlansCadresController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        return $this->sendResponse(PlansCadresResource::collection(PlanCadre::all()->sortBy('code')));
    }

    /**
     * Méthode qui retourne tous les plans cadres qui ont un certain programme
     * @param string $programmeId L'id du programme duquel on veut recevoir les plans cadres
     * @return JsonResponse
     */
    public function indexParProgramme(string $programmeId){
        Gate::authorize('est_authentifie');
        return $this->sendResponse(PlansCadresResource::collection(PlanCadre::all()->where('programme_id', '=', $programmeId)->sortBy('code')));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        Gate::authorize('est_authentifie');
        $this->validatePlanCadre($request);
        $complet = $this->verifierSiPlanCadreComplet($request);
        $planCadre = PlanCadre::create([
            'code'=>$request->code,
            'titre'=>$request->titre,
            'ponderation'=>$request->ponderation,
            'unites'=>$request->unites,
            'ponderationFinale'=>$request->ponderationFinale,
            'changement'=>new DateTime(),
            'complet'=>$complet,
        ]);


        //Associer le gabarit
        $planCadre->associer_gabarit(2);
        //Associer les sections
        $planCadre->associer_sections($request->json('sections'));


        //Aller chercher la section des attitudes
        foreach ($request->sections as $section){
            if(str_contains(strtolower(Section::all()->where("id", "=", $section['id'])->first()->titre), "attitude")){
                $sectionTexte = $section['texte'];
                $planCadre->attitudes = $sectionTexte;
                break;
            }
        }


        //Assigner le programme
        if(isset($request->programme)){
            $planCadre->associer_programme($request->programme);
        }

        //Assigner la session
        if(isset($request->entreVigueur)){
            $planCadre->associer_session($request->entreVigueur['id']);
        }


        if(isset($request->criteresEvaluations)){
            //Assigner le plan cadre aux critères d'évaluations
            foreach ($request->criteresEvaluations as $criteresEvaluation){
                CritereEvaluation::find($criteresEvaluation['id'])->associerPlanCadre($planCadre->id);
            }
        }


        //Vérifier d'il y a des préalables relatifs
        if(isset($request->coursLiesPrealablesRelatifs)){
            //Ajouter les plans cadres relatifs
            foreach ($request->coursLiesPrealablesRelatifs as $prealableRelatif){
                $planCadre->ajouterPlanCadrePrealableRelatif($prealableRelatif['id']);
                $prealableRelatif = PlanCadre::find($prealableRelatif['id']);
                $prealableRelatif->ajouterPlanCadreSuivant($planCadre->id);
            }
        }

        //Vérifier d'il y a des préalables absolus
        if(isset($request->coursLiesPrealablesAbsolus)){
            //Ajouter les plans cadres absolus
            foreach ($request->coursLiesPrealablesAbsolus as $prealableAbsolu){
                $planCadre->ajouterPlanCadrePrealableAbsolu($prealableAbsolu['id']);
                $prealableAbsolu = PlanCadre::find($prealableAbsolu['id']);
                $prealableAbsolu->ajouterPlanCadreSuivant($planCadre->id);
            }
        }

        //Vérifier s'il y a des corequis
        if(isset($request->coursLiesCorequis)){
            //Ajouter les plans cadres corequis
            foreach ($request->coursLiesCorequis as $corequis){
                $planCadre->ajouterPlanCadreCorequis($corequis['id']);
                $corequis = PlanCadre::find($corequis['id']);
                $corequis->ajouterPlanCadreCorequis($planCadre->id);
            }
        }



        //Ajouter les compétences
        if(isset($request->competences)){

            foreach ($request->competences as $competences){
                //Ajouter les éléments de compétences avec le contenu local
                if(isset($competences['elementsCompetences'])){
                    foreach ($competences['elementsCompetences'] as $elementCompetence){
                        $planCadre->ajouterElementCompetence($elementCompetence['id'], $elementCompetence['contenuLocal']);
                    }
                }
                //Vérifier si c'est une compétence complète ou partielle
                if($competences['atteinte'] == "Partielle"){
                    $competencesObjet = Competence::all()->where('id', '=', $competences['id'])->first();
                    $planCadre->ajouter_competence_partielle($competencesObjet, $competences['contexteLocal'], $competences['progression']);
                }
                elseif($competences['atteinte'] == "Complète"){
                    //Aller chercher l'objet compétence
                    $competencesObjet = Competence::all()->where('id', '=', $competences['id'])->first();
                    $planCadre->ajouter_competence_complete($competencesObjet, $competences['contexteLocal']);
                }

            }
        }

        return $this->sendResponse(PlansCadresResource::make($planCadre), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Gate::authorize('est_authentifie');
        //Aller chercher le plan cadre à retourner
        $planCadre = PlanCadre::find($id);

        //Vérifier si on a bien trouvé un plan cadre
        if(isset($planCadre)){
            return $this->sendResponse(new PlansCadresResource($planCadre));
        }

        //Sinon retourné une erreur
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
        $this->validatePlanCadre($request);
        //Aller chercher le plan cadre correspondant au id donné
        $planCadre = PlanCadre::find($id);

        //Vérifier qu'un plan cadre a bien été trouvé
        if($planCadre){
            $planCadre->update([
                'code'=>$request->code,
                'titre'=>$request->titre,
                'ponderation'=>$request->ponderation,
                'unites'=>$request->unites,
                'ponderationFinale'=>$request->ponderationFinale,
                'changement'=>new DateTime(),
            ]);


            //Associer les sections
            $planCadre->associer_sections($request->json('sections'));


            //Aller chercher la section des attitudes
            foreach ($request->sections as $section){
                if(str_contains(strtolower(Section::all()->where("id", "=", $section['id'])->first()->titre), "attitude")){
                    $sectionTexte = $section['texte'];
                    $planCadre->attitudes = $sectionTexte;
                    break;
                }
            }


            //Modifier le programme
            if(isset($request->programme)){
                $planCadre->associer_programme($request->programme);
            }

            //Modifier la session
            if(isset($request->entreVigueur)){
                $planCadre->associer_session($request->entreVigueur['id']);
            }


            //Assigner les critères d'évaluation
            if(isset($request->criteresEvaluations)){
                foreach ($request->criteresEvaluations as $critereEvaluation){
                    $critereEvaluation = CritereEvaluation::find($critereEvaluation['id']);
                    $critereEvaluation->associerPlanCadre($planCadre->id);

                }
            }


            //Retirer les anciens préalables absolus
            $planCadre->enleverPlusieursPlanCadre($planCadre->PlansCadresAbolus->pluck('id'));
            foreach ($planCadre->PlansCadresAbolus as $prealableAbsolu){
                /**
                 * Erreur on dirait qu'il ne s'enlève pas
                 */

                $prealableAbsolu = PlanCadre::find($prealableAbsolu['id']);
                $prealableAbsolu->enleverPlanCadre($planCadre->id);
            }
//            return $this->sendResponse(PlansCadresResource::collection($planCadre->PlansCadresAbolus));

            //Vérifier d'il y a des préalables absolus
            if(isset($request->coursLiesPrealablesAbsolus)){
                //Ajouter les plans cadres absolus
                foreach ($request->coursLiesPrealablesAbsolus as $prealableAbsolu){
                    if(!$planCadre->PlansCadresAbolus->contains($prealableAbsolu)){
                        $planCadre->ajouterPlanCadrePrealableAbsolu($prealableAbsolu['id']);
                        $prealableAbsolu = PlanCadre::find($prealableAbsolu['id']);
                        $prealableAbsolu->ajouterPlanCadreSuivant($planCadre->id);
                    }

                }
            }



            //Retirer les anciens préalables relatif
            foreach ($planCadre->PlansCadresRelatifs as $prealableRelatif){
                $planCadre->enleverPlanCadre($prealableRelatif->id);
                $prealableRelatif->enleverPlanCadre($planCadre->id);
            }

            //Vérifier d'il y a des préalables relatifs
            if(isset($request->coursLiesPrealablesRelatifs)){
                //Ajouter les plans cadres relatifs
                foreach ($request->coursLiesPrealablesRelatifs as $prealableRelatif){
                    if(!$planCadre->PlansCadresAbolus->contains($prealableAbsolu)) {
                        $planCadre->ajouterPlanCadrePrealableRelatif($prealableRelatif['id']);
                        $prealableRelatif = PlanCadre::find($prealableRelatif['id']);
                        $prealableRelatif->ajouterPlanCadreSuivant($planCadre->id);
                    }
                }
            }




            //Retirer les anciens corequis
            foreach ($planCadre->PlansCadresCorequis as $corequis){
                $corequis->enleverPlanCadre($planCadre->id);
                $planCadre->enleverPlanCadre($corequis->id);
            }

            //Vérifier s'il y a des corequis
            if(isset($request->coursLiesCorequis)){
                //Ajouter les plans cadres corequis
                foreach ($request->coursLiesCorequis as $corequis){
                    $corequis = PlanCadre::find($corequis['id']);
                    $planCadre->ajouterPlanCadreCorequis($corequis->id);
                    $corequis->ajouterPlanCadreCorequis($planCadre->id);
                }
            }



            //Enlever les anciens éléments de compétences
            foreach ($planCadre->element_competence as $elementCompetence){
                $planCadre->enleverElementCompetence($elementCompetence['id']);
            }

            //Enlever les anciennes compétences
            foreach ($planCadre->competence as $competence){
                $planCadre->enlever_competence($competence->id);
            }

            //Ajouter les compétences
            /**
             * @authors Jacob Beauregard-Tousignant, Jérémy Lebel
             */
            if(isset($request->competences)){
                foreach ($request->competences as $competences){
                    //Ajouter les éléments de compétences avec le contenu local
                    if(isset($competences['elementsCompetences'])){
                        foreach ($competences['elementsCompetences'] as $elementCompetence){
                            $planCadre->ajouterElementCompetence($elementCompetence['id'], $elementCompetence['contenuLocal']);
                        }
                    }
                    //Vérifier si c'est une compétence complète ou partielle
                    if($competences['atteinte'] == "Partielle"){
                        $competencesObjet = Competence::all()->where('id', '=', $competences['id'])->first();
                        $planCadre->ajouter_competence_partielle($competencesObjet, $competences['contexteLocal'], $competences['progression']);
                    }
                    elseif($competences['atteinte'] == "Complète"){
                        //Aller chercher l'objet compétence
                        $competencesObjet = Competence::all()->where('id', '=', $competences['id'])->first();
                        $planCadre->ajouter_competence_complete($competencesObjet, $competences['contexteLocal']);
                    }

                }
            }



            return $this->sendResponse(PlansCadresResource::make($planCadre), 201);
        }
        else{
            return $this->sendError("Plan cadre non trouvé.");
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        //Aller chercher le plan cadre à supprimer
        $planCadre = PlanCadre::find($id);
        //Vérifier si le plan cadre a été trouvé
        if(isset($planCadre)){
            //Supprimer le plan cadre de la BD
            $planCadre->delete();
            //Retourner la liste de tous les plans cadres
            return $this->sendResponse(PlansCadresResource::collection(PlanCadre::all()->sortBy('code')));
        }
        //Si le plan cadre n'a pas été trouvé, retourner une erreur
        else{
            return $this->sendError('Plan cadre non trouvé');
        }

    }





    /**
     * Méthode pour la validation des plans cadres.
     * La base est prise du projet final de PHP de Jacob de H23
     * @param Request $request
     * @return array
     */
    private function validatePlanCadre(Request $request){
        $aujourdhui = date('Y-m-d');
        return $request->validate([
            'code' => array('required', 'string', 'regex:/^\d{3}-\d[A-Z]\d-[A-Z]{2}$/i'),
            'titre' => 'required|string|min:3',
            'ponderation' => array('required', 'string', 'regex:/^\d-\d-\d$/i'),
            'unites' => 'nullable|numeric|between:0,20',
            'dateApprobationDepartement' => 'nullable|date|before_or_equal:'.$aujourdhui,
            'changement' => 'nullable|date|before_or_equal:'.$aujourdhui,
            'dateApprobationComiteProgrammes' => 'nullable|date|before_or_equal:'.$aujourdhui,
            'dateDepotDirectionEtudes' => 'nullable|date|before_or_equal:'.$aujourdhui,
            'ponderationFinale' => 'nullable|integer|between:0,100',
        ]);
    }


    /**
     * Méthode pour vérifier si un plan-cadre est complet
     * @param Request $request
     * @return bool
     */
    private function verifierSiPlanCadreComplet(Request $request): bool {
        try {
            $aujourdhui = date('Y-m-d');
            foreach($request->json('sections') as $s){
                $section = Section::find($s['id']);
                if($section->obligatoire && $section->type_section_id === 1){
                    $validation = Validator::make($s, [
                        'texte' => ['required']
                    ]);
                    if($validation->fails()){
                        return false;
                    }
                }
            }
            $request->validate([
                'code' => 'required',
                'titre' => 'required',
                'ponderation' => 'required',
                'unites' => 'required',
                'ponderationFinale' => 'required',
            ]);
            return true;
        } catch (ValidationException $e){
            return false;
        }
    }




}
