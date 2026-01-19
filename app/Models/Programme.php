<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Programme extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'titre'
    ];

    //Relation entre Programme et competences
    public function competences(): HasMany
    {
        return $this->hasMany(Competence::class);
    }

    //Méthode pour ajouter une competence a un programme
   public function ajouterCompetence($competences){
        $this->competences()->saveMany($competences);
        $this->save();
    }

    //Méthode pour dissocier tout les programmes de la competence
    public function dissocier_toutes_competences(): void {
        foreach ($this->competences as $competence) {
            $competence->dissocier_programme();
        }
    }

    /**
     * Méthode pour récupérer les plans-cadres associés au programme.
     * @return HasMany les plans-cadres associés au programme (HasMany)
     */
    public function plans_cadres(): HasMany {
        return $this->hasMany(PlanCadre::class);
    }

    /**
     * Méthode pour récupérer les plans de cours des plans-cadres associés au programme.
     * @return HasManyThrough les plans de cours des plans-cadres associés au programme (HasManyThrough)
     * @author Emeric Chauret
     */
    public function plans_cours(): HasManyThrough {
        return $this->hasManyThrough(PlanCours::class, PlanCadre::class);
    }
}
