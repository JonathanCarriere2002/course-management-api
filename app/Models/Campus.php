<?php

/**
 * @author Emeric Chauret
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campus extends Model
{
    // Utilisation d'un factory pour les campus
    use HasFactory;

    /**
     * Propriétés pouvant être insérées ou mises à jour dans la base de données.
     * @var string[] la liste des propriétés qui sont 'fillable' (string[])
     */
    protected $fillable = [
        'nom'
    ];

    /**
     * Méthode qui définit une relation "One-to-Many" entre Campus et Plan de cours.
     * @return HasMany les plans de cours associés au campus
     */
    public function plans_cours(): HasMany {
        return $this->hasMany(PlanCours::class);
    }
}
