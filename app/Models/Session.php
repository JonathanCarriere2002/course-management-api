<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modèle représentant une session
 * @author Jonathan Carrière
 */
class Session extends Model
{
    // Utilisation d'un factory pour les sessions
    use HasFactory;

    /**
     * Propriétés pouvant être insérées ou mises à jour dans la base de données
     * @var string[] Liste des propriétés qui sont 'fillable'
     */
    protected $fillable = [
        'session',
        'annee',
        'limite_abandon'
    ];

    /**
     * Relation entre une session et ses plans cadre
     * @return HasMany Une session possède plusieurs plans cadre
     */
    public function plansCadres():hasMany {
        return $this->hasMany(PlanCadre::class,"session_id");
    }

    /**
     * Relation entre une session et ses plans de cours
     * @return HasMany Une session possède plusieurs plans de cours
     */
    public function plansCours():hasMany {
        return $this->hasMany(PlanCours::class,"session_id");
    }

}
