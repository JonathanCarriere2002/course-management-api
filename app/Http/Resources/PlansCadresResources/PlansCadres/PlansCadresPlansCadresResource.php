<?php

/**
 * @author Jacob Beauregard-Tousignant
 */


namespace App\Http\Resources\PlansCadresResources\PlansCadres;

use App\Models\PlanCadre;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlansCadresPlansCadresResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id'=>$this->id,
            'planCadre1'=>PlanCadreAbregeResource::make(PlanCadre::all()->where('id', '=', $this->pivot->id_plan_cadre1)->first()),
            'planCadre2'=>PlanCadreAbregeResource::make(PlanCadre::all()->where('id', '=', $this->pivot->id_plan_cadre2)->first()),
        ];
    }
}
