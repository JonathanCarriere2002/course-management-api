<?php

namespace App\Http\Controllers\PlanCoursController;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PlanCoursResources\PlanCoursResource;
use App\Models\Gabarit;
use App\Models\PlanCadre;
use App\Models\PlanCours;
use App\Models\Programme;
use App\Models\Section;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

/**
 * Contrôleur permettant d'effectuer la gestion des plans de cours
 * @author Emeric Chauret
 * @author Jonathan Carrière
 */
class PlanCoursController extends BaseController
{
    /**
     * Méthode qui retourne la liste des plans de cours dans la bd sous format json.
     * @return JsonResponse la liste des plans de cours dans la bd sous format json (JsonResponse)
     * @author Emeric Chauret
     */
    public function index(string $programme_id): JsonResponse
    {
        Gate::authorize('peut_afficher_plan_cours', $programme_id);
        $programme = Programme::find($programme_id);
        return $this->sendResponse(PlanCoursResource::collection($programme->plans_cours));
    }

    /**
     * Méthode qui crée un plan de cours dans la bd.
     * @param  Request  $request la requête qui contient les données du plan de cours à créer dans la bd (Request)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     * @authors Emeric Chauret, Jonathan Carrière
     */
    public function store(Request $request, string $programme_id): JsonResponse
    {
        Gate::authorize('peut_creer_plan_cours', $programme_id);
        // Valider le plan de cours
        $this->validatePlanCours(1, $programme_id, $request);
        // Vérifier si le plan de cours est rempli complètement
        $complet = $this->verifierSiPlanCoursComplet($request);
        // Créer un plan de cours
        $plancours = PlanCours::create([
            "complet" => $complet,
            "cree_par" => Auth::user()->id
        ]);
        // Effectuer l'association des objets ayant une relation aux plans de cours
        $plancours->associer_gabarit(1);
        $plancours->associer_plan_cadre($request->json('plan_cadre.id'));
        $plancours->associer_campus($request->json('campus.id'));
        $plancours->associer_session($request->json('session.id'));
        $plancours->associer_sections($request->json('sections'));
        $plancours->associer_enseignants($request->json('enseignants'));
        $plancours->associer_semaines_cours($request->json('semaines_cours'));
        // Retourner l'ensemble des plans de cours sous le format JSON
        return $this->sendResponse('', 201);
    }

    /**
     * Méthode qui retourne un plan de cours dans la bd.
     * @param  string  $plan_cours_id l'identifiant du plan de cours à récupérer dans la bd (string)
     * @return JsonResponse le plan de cours récupéré dans la bd sous format json (JsonResponse)
     * @author Emeric Chauret
     */
    public function show(string $programme_id, string $plan_cours_id): JsonResponse
    {
        Gate::authorize('peut_afficher_plan_cours', $programme_id);
        // Obtenir le plan de cours de la base de données en utilisant son Id
        $plancours = PlanCours::find($plan_cours_id);
        // Vérifier si le plan de cours ayant l'Id spécifiée existe
        if($plancours){
            // Retourner le plan de cours ayant l'Id spécifié
            return $this->sendResponse(PlanCoursResource::make($plancours));
        }
        // Retourner une erreur si le plan de cours n'est pas trouvé
        return $this->sendError('Plan de cours non trouvé');
    }

    /**
     * Méthode qui modifie un plan de cours dans la bd.
     * @param  Request  $request la requête qui contient les nouvelles données du plan de cours à modifier dans la bd (Request)
     * @param  string  $plan_cours_id l'identifiant du plan de cours à modifier dans la bd (string)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     * @authors Emeric Chauret, Jonathan Carrière
     */
    public function update(Request $request, string $programme_id, string $plan_cours_id): JsonResponse
    {
        // Obtenir le plan de cours de la base de données en utilisant son Id
        $plancours = PlanCours::find($plan_cours_id);
        Gate::authorize('peut_modifier_ou_supprimer_plan_cours', [$programme_id, $plancours]);
        // Vérifier si le plan de cours ayant l'Id spécifiée existe
        if($plancours){
            // Valider le plan de cours
            $this->validatePlanCours(1, $programme_id, $request);
            // Vérifier si le plan de cours est rempli complètement
            $complet = $this->verifierSiPlanCoursComplet($request);
            // Mettre à jour le plan de cours
            $plancours->update([
                "complet" => $complet
            ]);
            // Associer les objets ayant une relation avec le plan de cours
            $plancours->associer_plan_cadre($request->json('plan_cadre.id'));
            $plancours->associer_campus($request->json('campus.id'));
            $plancours->associer_session($request->json('session.id'));
            $plancours->associer_sections($request->json('sections'));
            $plancours->associer_enseignants($request->json('enseignants'));
            $plancours->associer_semaines_cours($request->json('semaines_cours'));
            // Retourner l'ensemble des plans de cours sous le format JSON
            return $this->sendResponse('');
        }
        // Retourner une erreur si le plan de cours n'est pas trouvé
        return $this->sendError('Plan de cours non trouvé');
    }

    /**
     * Méthode qui supprime un plan de cours dans la bd.
     * @param  string  $plan_cours_id l'identifiant du plan de cours à supprimer dans la bd (string)
     * @return JsonResponse une réponse sous format json (JsonResponse)
     * @author Emeric Chauret
     */
    public function destroy(string $programme_id, string $plan_cours_id): JsonResponse
    {
        // Obtenir le plan de cours de la base de données en utilisant son Id
        $plancours = PlanCours::find($plan_cours_id);
        Gate::authorize('peut_modifier_ou_supprimer_plan_cours', [$programme_id, $plancours]);
        // Vérifier si le plan de cours ayant l'Id spécifiée existe
        if($plancours){
            // Supprimer le plan de cours de la base de données
            $plancours->delete();
            // Retourner l'ensemble des plans de cours sous le format JSON
            return $this->sendResponse('');
        }
        // Retourner une erreur si le plan de cours n'est pas trouvé
        return $this->sendError('Plan de cours non trouvé');
    }

    /**
     * Méthode pour valider les données entrées par l'utilisateur
     * dans le formulaire pour créer et modifier un plan de cours.
     * @param  int  $gabarit_id l'id du gabarit du plan de cours (Gabarit)
     * @param  int  $programme_id l'id du programme relié au plan de cours (Programme)
     * @param  Request  $request la requête qui contient les données à valider (Request)
     * @return array un tableau avec les données validées (array)
     * @authors Emeric Chauret, Jonathan Carrière
     */
    private function validatePlanCours(int $gabarit_id, int $programme_id, Request $request): array {
        $gabarit = Gabarit::find($gabarit_id);
        $programme = Programme::find($programme_id);
        $plan_cadre = PlanCadre::find($request->json('plan_cadre.id'));
        $sections_ids = $gabarit->sections->pluck('id');
        $plans_cadres_ids = $programme->plans_cadres->pluck('id');
        $elements_competences_ids = $plan_cadre->elements_competences_ids();
        return $request->validate([
            'plan_cadre.id' => ['required', 'exists:plans_cadres,id', Rule::in($plans_cadres_ids)],
            'campus.id' => ['required', 'exists:campuses,id'],
            'session.id' => ['required', 'exists:sessions,id'],
            'enseignants' => ['present', 'array'],
            'enseignants.*.id' => ['required', 'exists:enseignants,id'],
            'enseignants.*.groupe' => ['nullable', 'integer', 'min:1'],
            'enseignants.*.dispo' => ['nullable', 'string'],
            'sections' => ['present', 'array'],
            'sections.*.id' => ['required', 'exists:sections,id', Rule::in($sections_ids)],
            'sections.*.texte' => ['nullable', 'string'],
            'semaines_cours' => ['present', 'array'],
            'semaines_cours.*.id' => ['nullable', 'integer', 'exists:semaine_cours,id'],
            'semaines_cours.*.semaineDebut' => ['required', 'integer', 'between:1,15'],
            'semaines_cours.*.semaineFin' => ['required', 'integer', 'between:1,15'],
            'semaines_cours.*.contenu' => ['nullable', 'string'],
            'semaines_cours.*.activites' => ['nullable', 'string'],
            'semaines_cours.*.elementsCompetences' => ['present', 'array'],
            'semaines_cours.*.elementsCompetences.*.id' => ['required', 'exists:elements_competence,id', Rule::in($elements_competences_ids)]
        ]);
    }

    /**
     * Méthode qui vérifie si le plan de cours a été rempli complètement.
     * @param  Request  $request la requête qui contient les données à vérifier (Request)
     * @return bool un booléen qui indique si le plan de cours est complet ou non (bool)
     * @author Emeric Chauret
     */
    private function verifierSiPlanCoursComplet(Request $request): bool {
        try {
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
                'enseignants' => ['required', 'min:1'],
                'enseignants.*.groupe' => ['required'],
                'enseignants.*.dispo' => ['required'],
                'semaines_cours' => ['required', 'min:1'],
                'semaines_cours.*.semaineDebut' => ['required'],
                'semaines_cours.*.semaineFin' => ['required'],
                'semaines_cours.*.contenu' => ['required'],
                'semaines_cours.*.activites' => ['required'],
                'semaines_cours.*.elementsCompetences' => ['required', 'min:1']
            ]);
            return true;
        } catch (ValidationException $e){
            return false;
        }
    }
}
