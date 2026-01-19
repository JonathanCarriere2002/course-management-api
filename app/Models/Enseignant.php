<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Modèle représentant un enseignant
 * @author Jonathan Carrière
 */
class Enseignant extends Model
{
    // Utilisation d'un factory pour les enseignants
    use HasFactory;

    /**
     * Propriétés pouvant être insérées ou mises à jour dans la base de données
     * @var string[] Liste des propriétés qui sont 'fillable'
     */
    protected $fillable = [
        'prenom',
        'nom',
        'courriel',
        'bureau',
        'poste'
    ];

    /**
     * Relation entre un enseignant et ses plans de cours
     * @return BelongsToMany Un enseignant appartient à plusieurs plans de cours
     */
    public function plansCours():belongsToMany {
        return $this->belongsToMany(PlanCours::class, 'enseignant_plan_cours', 'enseignant_id', 'plan_cours_id');
    }

    /**
     * Relation entre un enseignant et ses programmes
     * @return BelongsToMany Un enseignant appartient à plusieurs programmes
     */
    public function programmes():belongsToMany {
        return $this->belongsToMany(Programme::class, 'enseignant_programme', 'enseignant_id', 'programme_id');
    }

    /**
     * Fonction permettant d'associer les programmes à un enseignant
     */
    public function associerProgrammes($programmes): void {
        $listeProgrammes = array_map(fn($programme) => $programme['id'], $programmes);
        $this->programmes()->sync($listeProgrammes);
        $this->save();
    }

    /**
     * Fonction permettant d'associer les programmes à un enseignant dans le seeder
     */
    public function associerProgrammesSeeder($programmes): void {
        $this->programmes()->sync($programmes);
        $this->save();
    }

}
