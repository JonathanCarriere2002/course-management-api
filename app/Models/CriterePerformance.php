<?php
/* @author lebel */
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriterePerformance extends Model
{
    // Defenir le table dans la BD manuellement
    protected $table = "criteres_performance";

    use HasFactory;

    protected $fillable = [
        'numero',
        'texte',
        'isExpanded'
    ];

    /*
     * Un critere de perfo appartient à un element de comp
     */
    public function element_competences(){
        return $this->belongsTo(ElementCompetence::class, 'element_competence_id');
    }
    /** Methode pour associer un element de competence a un critere de performance
     * @param $element_competence_id
     * @return void
     */
    public function associer_element_competences($element_competence_id): void {
        $this->element_competences()->associate($element_competence_id);
        $this->save();
    }
}
