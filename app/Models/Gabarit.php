<?php

/**
 * @author Emeric Chauret
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gabarit extends Model
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
     * Méthode qui définit une relation "Many-to-Many" entre Gabarit et Section.
     * @return BelongsToMany les sections associées au gabarit
     */
    public function sections(): BelongsToMany {
        return $this->belongsToMany(Section::class)->withPivot(['ordre'])->orderBy('ordre');
    }

    /**
     * Méthode qui permet d'associer des sections au gabarit.
     * @param $sections
     * @return void
     */
    public function associer_sections($sections): void {
        $a = array_combine(array_map(fn($section) => $section['id'], $sections),
            array_map(function ($section, $index) : array {
            return ['ordre' => $index + 1];
        }, $sections, array_keys($sections)));
        $this->sections()->sync($a);
        $this->save();
    }



    /**
     * Méthode qui définit une relation "One-to-Many" entre Gabarit et Plan de cours.
     * @return HasMany les plans de cours associés au gabarit
     */
    public function plans_cours(): HasMany {
        return $this->hasMany(PlanCours::class);
    }
}
