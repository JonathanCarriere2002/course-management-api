<?php
/* @author lebel */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementCompetence extends Model
{
    // Defenir le table dans la BD manuellement
    protected $table = "elements_competence";

    use HasFactory;

    protected $fillable = [
        'numero',
        'texte',
        'isExpanded'
    ];

    // Un element de comp à une competence
    public function competence(){
        return $this->belongsTo(Competence::class, 'competence_id');
    }
    /** Methode pour lier un element de comp à une competence
     * @param $competence_id
     * @return void
     */
    public function associer_competence($competence_id): void {
        $this->competence()->associate($competence_id);
        $this->save();
    }


    // Un element de comp contient plusieurs criteres d'evaluation
    public function criteres_performances(){
        return $this->hasMany(CriterePerformance::class, 'element_competence_id');
    }
    /** Methode pour lier des cirteres de performance a un element de comp
     * @param $criteres_performance
     * @return void
     * /
    public function associer_criteres_performances($criteres_performance): void {
        $this->criteres_performances()->saveMany($criteres_performance);
    }*/


    //  Un element de comp est lié à plusieurs plans cadre
    public function plans_cadre(){
        return $this->belongsToMany(PlanCadre::class);
    }
    /** Methode pour lier des plans cadre à un element de competence
     * @param $plans_cadres
     * @return void
     * /
    public function associer_plans_cadre($plans_cadres): void {
        $this->plans_cadre()->sync($plans_cadres);
        $this->save();
    }*/


    // Un element de comp est lié plusieurs semaines de cours
    public function semaines_cours(){
        return $this->belongsToMany(SemaineCours::class);
    }
    /** Methode pour lier les semaines de cours a un element de competence
     * @param $semaines_cours
     * @return void
     * /
    public function associer_semaine_cours($semaines_cours): void {
        $this->semaines_cours()->sync($semaines_cours);
        $this->save();
    }*/


    // Liaison avec critere eval
    public function criteres_evaluation(){
        return $this->belongsToMany(CritereEvaluation::class);
    }
    /** Methode pour lier un element de competenc a un ou des criteres d'eval
     * @param $criteres_evaluation
     * @return void
     * /
    public function associer_criteres_evaluation($criteres_evaluation): void {
        $this->criteres_evaluation()->sync($criteres_evaluation);
     */
}
