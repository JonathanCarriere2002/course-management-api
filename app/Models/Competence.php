<?php
/* @author lebel */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    // Defenir le table dans la BD manuellement
    protected $table = "competences";

    use HasFactory;

    protected $fillable = [
        'code',
        'enonce',
        'annee_devis',
        'pages_devis',
        'contexte',
    ];


    // Une competence a un ou plusieurs element de competence
    public function elements_competences(){
        return $this->hasMany(ElementCompetence::class, 'competence_id');
    }
    /** Methodes pour lier des elements de competences a une competence
     * @param $elements_comp
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * /
     * public function associer_elements_competence($elements_comp): void{
        * $this->elements_competences()->saveMany($elements_comp);
    * }*/


    // Une competence peut etre lie à plusieurs plans cadre
   public function plans_cadres(){
        return $this->belongsToMany(PlanCadre::class);
    }


    // Une competence est lié à un programme
    public function programme(){
        return $this->belongsTo(Programme::class, 'programme_id');
    }
    /** Methode qui permet de lier une competence a un programme
     * @param $programme_id
     * @return void
     */
    public function associer_programme($programme_id): void{
        $this->programme()->associate($programme_id);
        $this->save();
    }

    /** Methode dissocie les programme en mettant programme_id a null
     * @return void
     */
    public function dissocier_programme(): void {
        $this->programme_id = null;
        $this->save();
    }
}
