<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modèle représentant une semaine de cours
 * @author Jonathan Carrière
 */
class SemaineCours extends Model
{
    // Utilisation d'un factory pour les semaines de cours
    use HasFactory;

    /**
     * Propriétés pouvant être insérées ou mises à jour dans la base de données
     * @var string[] Liste des propriétés qui sont 'fillable'
     */
    protected $fillable = [
        'semaineDebut',
        'semaineFin',
        'contenu',
        'activites'
    ];

    /**
     * Relation entre une semaine de cours et ses éléments de compétences
     * @return BelongsToMany Une semaine de cours appartient à plusieurs éléments de compétences
     */
    public function elementsCompetences():belongsToMany {
        return $this->belongsToMany(ElementCompetence::class, 'element_competence_semaine_cours', 'semaine_cours_id', 'element_competence_id')->orderBy('numero');
    }

    /**
     * Relation entre une semaine de cours et son plan de cours
     * @return BelongsTo Une semaine de cours appartient à un plan de cours
     */
    public function planCours():belongsTo {
        return $this->belongsTo(PlanCours::class, 'plan_cours_id');
    }

    /**
     * Fonction permettant d'associer les éléments de compétence à une semaine de cours
     */
    public function associerElementsCompetences($elementsCompetences): void {
        $listeElementsCompetences= array_map(fn($element) => $element['id'], $elementsCompetences);
        $this->elementsCompetences()->sync($listeElementsCompetences);
        $this->save();
    }

    /**
     * Fonction permettant d'associer les éléments de compétence à une semaine de cours dans le seeder
     */
    public function associerElementsCompetencesSeeder($planCoursId, $nbrElementsCompetence): void {
        // Trouver le plan-cadre associé au plan de cours de la semaine de cours
        $planCadre = PlanCours::find($planCoursId)->plan_cadre;
        // Obtenir la liste des éléments de compétences associées au plan-cadre du plan de cours
        $elementsCompetences = $planCadre->elements_competences_ids();
        // Sélectionner une quantité spécifique des éléments de compétences pour l'association
        $elementsCompetencesChoisis = array_slice($elementsCompetences, 0, $nbrElementsCompetence);
        // Associé la liste des éléments de compétences à la semaine de cours et sauvegarder les changements
        $this->elementsCompetences()->sync($elementsCompetencesChoisis);
        $this->save();
    }

    /**
     * Fonction permettant d'associer une semaine de cours à son plan de cours
     */
    public function associerPlanCours($plan_cours_id): void {
        $this->planCours()->associate($plan_cours_id);
        $this->save();
    }

}
