<?php

namespace App\Http\Resources\PlansCadresResources\PlansCadres;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanCadreAbregePourCompetencePlanCadreResource extends JsonResource
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
            'titre'=>$this->titre,
            'code'=>$this->code,
            'attitudes'=>$this->attitudes,
        ];
    }
}
