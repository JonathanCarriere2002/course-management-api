<?php

/**
 * @author Jacob Beauregard-Tousignant
 */


namespace App\Http\Resources\PlansCadresResources\PlansCadres;

use App\Http\Resources\PlanCoursResources\SectionPlanCoursResource;
use App\Http\Resources\PlansCadresResources\CriteresEvaluation\CriteresEvaluationsResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlansCadresResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "code"=>$this->code,
            "titre"=>$this->titre,
            "ponderation"=>$this->ponderation,
            "unites"=>$this->unites,
            "sections" => SectionPlanCoursResource::collection($this->sections_en_ordre()),
            "attitudes"=>$this->attitudes,
            "complet"=>$this->complet,


            "ponderationFinale"=>$this->ponderationFinale,
            "programme"=>ProgrammePlanCadreResource::make($this->programme),
            "competences"=>CompetencePlanCadreResource::collection($this->competence),
            "elementsCompetences"=>ElementCompetencePlanCadreResource::collection($this->element_competence),
            "entreVigueur"=>PlanCadreSessionResource::make($this->session),
            "criteresEvaluations"=>CriteresEvaluationsResource::collection($this->criteres_evaluations),

            "coursLiesPrealablesRelatifs"=>PlansCadresPlansCadresResource::collection($this->PlansCadresRelatifs),

            "coursLiesPrealablesAbsolus"=>PlansCadresPlansCadresResource::collection($this->PlansCadresAbolus),

            "coursLiesCorequis"=>PlansCadresPlansCadresResource::collection($this->PlansCadresCorequis),

            "coursLiesSuivants"=>PlansCadresPlansCadresResource::collection($this->PlansCadresSuivants),

            "changement"=>$this->changement,
            "approbationDepartement"=>$this->dateApprobationDepartement,
            "approbationComite"=>$this->dateApprobationComiteProgrammes,
            "depotDirectionEtudes"=>$this->dateDepotDirectionEtudes
        ];
    }
}
