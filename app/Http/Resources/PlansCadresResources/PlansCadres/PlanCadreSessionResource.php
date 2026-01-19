<?php

namespace App\Http\Resources\PlansCadresResources\PlansCadres;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanCadreSessionResource extends JsonResource
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
            'session'=>$this->session,
            'annee'=>$this->annee,
            'limite_abandon'=>$this->limite_abandon
        ];
    }
}
