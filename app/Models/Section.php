<?php

/**
 * @author Emeric Chauret
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Section extends Model
{
    // Utilisation d'un factory pour les sections
    use HasFactory;

    /**
     * Propriétés pouvant être insérées ou mises à jour dans la base de données.
     * @var string[] la liste des propriétés qui sont 'fillable' (string[])
     */
    protected $fillable = [
      'titre',
      'info_suppl',
      'aide',
      'obligatoire'
    ];

    /**
     * Méthode qui définit une relation "Many-to-Many" entre Section et Gabarit.
     * @return BelongsToMany les gabarits associés à la section
     */
    public function gabarits(): BelongsToMany {
        return $this->belongsToMany(Gabarit::class)->withPivot(['ordre']);
    }

    /**
     * Méthode qui définit une relation "Many-to-Many" entre Section et Plan de cours.
     * @return BelongsToMany les plans de cours associés à la section
     */
    public function plans_cours(): BelongsToMany {
        return $this->belongsToMany(PlanCours::class);
    }

    /**
     * Méthode qui définit une relation "Many-to-Many" entre Section et Plan cadre.
     * @return BelongsToMany les plans cadres associés à la section
     */
    public function plans_cadres(): BelongsToMany {
        return $this->belongsToMany(PlanCadre::class);
    }

    /**
     * Méthode qui définit une relation "One-to-Many" entre Section et Type de section
     * @return BelongsTo le type de section associé à la section
     */
    public function type_section(): BelongsTo {
        return $this->belongsTo(TypeSection::class, 'type_section_id');
    }

    /**
     * Méthode qui permet d'associer un type de section à la section.
     * @param $type_section_id l'identifiant du type de section à associer à la section
     * @return void
     */
    public function associer_type_section($type_section_id): void {
        $this->type_section()->associate($type_section_id);
        $this->save();
    }
}
