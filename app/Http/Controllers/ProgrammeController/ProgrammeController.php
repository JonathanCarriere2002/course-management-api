<?php

namespace App\Http\Controllers\ProgrammeController;

use App\Http\Controllers\BaseController;
use App\Http\Resources\ProgrammeResources\ProgrammeResource;
use App\Models\Competence;
use App\Models\Programme;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProgrammeController extends BaseController
{
    public function index(): JsonResponse
    {
        //Trier et retourner l'ensemble des programme sous le format JSON
        return $this->sendResponse(ProgrammeResource::collection(Programme::all()->sortBy('code')), 201);
    }

    /**
     * Entreposer un nouveau programme dans la base de données
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');

        $this->validateProgramme($request);
        $programme = Programme::create([
            'code'=>$request->code,
            'titre'=>$request->titre,
        ]);

        // Associer les comnpetences a un programme
        if(isset($request->competence)){
            $programme->ajouterCompetence($request->competence);
        }

        return $this->sendResponse(ProgrammeResource::collection(Programme::all()->sortBy('code')), 201);
    }

    /**
     * Obtenir un programme spécifique selon son Id
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        // Obtenir le programme de la base de données avec son ID
        $programme = Programme::find($id);

        // Vérifier si le programme existe
        if ($programme) {
            // Retourner le programme sous le format JSON
            return $this->sendResponse(new ProgrammeResource($programme), 201);
        }

        // Si l'Id ne correspond pas à un programme existant, retourner une erreur
        return $this->sendError("Le programme spécifié n'existe pas");
    }

    /**
     * Mettre à jour un programme dans la base de données
     * @param Request $request
     * @param string
     * @return JsonResponse
     */
    public function update(Request $request, string $id):JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        // Obtenir le programme de la base de données avec son Id
        $programme = Programme::find($id);
        // Vérifier si le programme existe
        if ($programme) {
            // Valider le nouveau programme
            $this->validateProgramme($request);
            //Méthode pour dissocier tout les programmes de la competence
            $programme->dissocier_toutes_competences();
            // Mettre à jour le programme via les données provenant du formulaire
            $programme->update([
                'code'=>$request->code,
                'titre'=>$request->titre,
            ]);
            // Associer la liste des competences a un programme
            if(isset($request->competences)) {
                foreach ($request->competences as $competenceData) {
                    $competence = Competence::find($competenceData['id']);
                    // Associer la compétence au nouveau programme
                    $competence->associer_programme($programme->id);
                }
            }
            // Retourner la collection JSON contenant les programmes
            return $this->sendResponse(ProgrammeResource::make($programme));
        }
        // Si l'Id ne correspond pas à un programme existant, retourner une erreur
        return $this->sendError("Le programme spécifié n'existe pas");
    }

    /**
     * Supprimer un programme dans la base de données
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_cp_ou_srdp');
        // Obtenir le programme de la base de données avec son Id
        $programme = Programme::find($id);
        // Vérifier si le programme existe
        if ($programme) {
            // Supprimer le programme de la base de données
            Programme::destroy($id);
            // Retourner la collection JSON contenant les programmes
            return $this->sendResponse(ProgrammeResource::collection(Programme::all()->sortBy('code')), 201);
        }
        // Si l'Id ne correspond pas à un programme existant, retourner une erreur
        return $this->sendError("Le programme spécifié n'existe pas");
    }

    private function validateProgramme(Request $request){
        //Validation côté serveur
        return $request->validate([
            'code' => ['required', 'string', 'min:4', 'max:8'],
            'titre' => 'required|string|min:3',
        ]);
    }
}
