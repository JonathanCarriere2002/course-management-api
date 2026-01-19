<?php

/**
 * @author Jacob Beauregard-Tousignant
 */


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CritereEvaluation extends Model
{
    protected $table = "criteres_evaluation";

    use HasFactory;


    protected $fillable = [
        'enonce',
        'ponderation'
    ];


    /**
     * Relation entre le plan cadre et ses critères d'évaluation
     * @return BelongsTo
     */
    public function plan_cadre(): BelongsTo
    {
        return $this->belongsTo(PlanCadre::class,"plan_cadre_id");
    }

    /**
     * Méthode permettant d'associer un plan cadre au critère d'évaluation
     * @param PlanCadre $planCadre Le plan cadre à associer
     * @return void
     */
    public function associerPlanCadre(int $planCadreId):void{
        $this->plan_cadre()->associate($planCadreId);
        $this->save();
    }


    /**
     * TODO: Vérifier l'ordre des clé, est-ce que la première est celle de critère ou d'élément de compétence? Jacob
     * Relation entre les éléments de compétence et les critères d'évaluation
     * @return BelongsToMany
     */
    public function elements_competences():belongsToMany{
        return $this->belongsToMany(ElementCompetence::class, 'critere_evaluation_element_competence', 'id_critere_eval', 'id_element_compe');
    }


    /**
     * Méthode permettant d'attacher un nouvel élément de compétence et faire la relation
     * @param ElementCompetence $elementCompetence
     * @return void
     */
    public function ajouterElementCompetence(int $elementCompetenceId){
        $this->elements_competences()->attach([
            $elementCompetenceId
        ]);
        $this->save();
    }


    /**
     * Méthode pour retirer un élément de compétence du critère d'évaluation
     * @param ElementCompetence $elementCompetence
     * @return void
     */
    public function enleverElementCompetence(int $elementCompetenceId){
        $this->elements_competences()->detach([
            $elementCompetenceId
        ]);
        $this->save();
    }
}
