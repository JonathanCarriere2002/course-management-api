<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modèle représentant un plan de cours
 * @author Emeric Chauret
 * @author Jonathan Carrière
 */
class PlanCours extends Model
{
    // Utilisation d'un factory pour les plans de cours
    use HasFactory;

    /**
     * Propriétés pouvant être insérées ou mises à jour dans la base de données
     * @var string[] Liste des propriétés qui sont 'fillable'
     */
    protected $fillable = [
        'approbation',
        'complet',
        'cree_par'
    ];

    /**
     * Méthode qui définit une relation "One-to-Many" entre Plan de cours et Gabarit
     * @return BelongsTo le gabarit associé au plan de cours
     * @author Emeric Chauret
     */
    public function gabarit(): BelongsTo {
        return $this->belongsTo(Gabarit::class, 'gabarit_id');
    }

    /**
     * Méthode qui permet d'associer un gabarit au plan de cours.
     * @param $gabarit_id l'identifiant du gabarit à associer au plan de cours
     * @return void
     * @author Emeric Chauret
     */
    public function associer_gabarit($gabarit_id): void {
        $this->gabarit()->associate($gabarit_id);
        $this->save();
    }

    /**
     * Méthode qui définit une relation "One-to-Many" entre Plan de cours et Plan cadre
     * @return BelongsTo le plan cadre associé au plan de cours
     * @author Emeric Chauret
     */
    public function plan_cadre(): BelongsTo {
        return $this->belongsTo(PlanCadre::class, 'plan_cadre_id');
    }

    /**
     * Méthode qui permet d'associer un plan cadre au plan de cours.
     * @param $plan_cadre_id l'identifiant du plan cadre à associer au plan de cours
     * @return void
     * @author Emeric Chauret
     */
    public function associer_plan_cadre($plan_cadre_id): void {
        $this->plan_cadre()->associate($plan_cadre_id);
        $this->save();
    }

    /**
     * Méthode qui définit une relation "One-to-Many" entre Plan de cours et Campus
     * @return BelongsTo le campus associé au plan de cours
     * @author Emeric Chauret
     */
    public function campus(): BelongsTo {
        return $this->belongsTo(Campus::class, 'campus_id');
    }

    /**
     * Méthode qui permet d'associer un campus au plan de cours.
     * @param $campus_id l'identifiant du campus à associer au plan de cours
     * @return void
     * @author Emeric Chauret
     */
    public function associer_campus($campus_id): void {
        $this->campus()->associate($campus_id);
        $this->save();
    }

    /**
     * Méthode qui définit une relation "One-to-Many" entre Plan de cours et Session
     * @return BelongsTo la session associée au plan de cours
     * @author Emeric Chauret
     */
    public function session(): BelongsTo {
        return $this->belongsTo(Session::class, 'session_id');
    }

    /**
     * Méthode qui permet d'associer une session au plan de cours.
     * @param $session_id l'identifiant de la session à associer au plan de cours
     * @return void
     * @author Emeric Chauret
     */
    public function associer_session($session_id): void {
        $this->session()->associate($session_id);
        $this->save();
    }

    /**
     * Méthode qui définit une relation "Many-to-Many" entre Plan de cours et Section.
     * @return BelongsToMany les sections associées au plan de cours
     * @author Emeric Chauret
     */
    public function sections(): BelongsToMany {
        return $this->belongsToMany(Section::class)->withPivot(['texte']);
    }

    /**
     * Méthode qui retourne la liste des sections du plan de cours selon l'ordre du gabarit.
     * @return Collection les sections du plan de cours selon l'ordre du gabarit
     * @author Emeric Chauret
     */
    public function sections_en_ordre(): Collection {
        return $this->gabarit->sections->map(function($section) {
            return $this->sections->find($section->id);
        });
    }

    /**
     * Méthode qui permet d'associer des sections au plan de cours.
     * @param $sections
     * @return void
     * @author Emeric Chauret
     */
    public function associer_sections($sections): void {
        $a = array_combine(array_map(fn($section) => $section['id'], $sections),
            array_map(fn($section) => ['texte' => $section['texte']], $sections));
        $this->sections()->sync($a);
        $this->save();
    }

    /**
     * Méthode qui définit une relation "Many-to-Many" entre Plan de cours et Enseignant.
     * @return BelongsToMany les enseignants associées au plan de cours
     * @author Emeric Chauret
     */
    public function enseignants(): BelongsToMany {
        return $this->belongsToMany(Enseignant::class, 'enseignant_plan_cours', 'plan_cours_id', 'enseignant_id')->withPivot(['groupe', 'dispo']);
    }

    /**
     * Méthode qui permet d'associer des enseignants au plan de cours.
     * @param $enseignants
     * @return void
     * @author Emeric Chauret
     */
    public function associer_enseignants($enseignants): void {
        $a = array_combine(array_map(fn($enseignant) => $enseignant['id'], $enseignants),
            array_map(fn($enseignant) => ['groupe' => $enseignant['groupe'], 'dispo' => $enseignant['dispo']], $enseignants));
        $this->enseignants()->sync($a);
        $this->save();
    }

    /**
     * Méthode qui définit une relation "One-to-Many" entre Plan de cours et Semaine de cours.
     * @return HasMany Les semaines de cours associées au plan de cours
     * @author Emeric Chauret
     */
    public function semaines_cours(): HasMany {
        return $this->hasMany(SemaineCours::class, 'plan_cours_id');
    }

    /**
     * Fonction permettant d'associer des semaines de cours à un plan de cours
     * @author Jonathan Carrière
     */
    public function associer_semaines_cours($semainesCoursRequete): void {
        // Obtenir les identifiants des semaines de cours existantes pour le plan de cours
        $idSemaineCoursExistants = $this->semaines_cours()->pluck('id')->toArray();
        // Parcourir la liste des semaines de cours provenant de la requête
        foreach ($semainesCoursRequete as $semaineCours) {
            // Obtenir la semaine de cours existante dans la base de données sous forme de modèle
            $semaineCoursModele = SemaineCours::find($semaineCours['id']);
            // Vérifier si la semaine de cours existe et qu'elle est associée au plan de cours actuel
            if ($semaineCoursModele && $semaineCoursModele->plan_cours_id === $this->id) {
                // Mettre à jour la semaine de cours dans la base de données
                $semaineCoursModele->update([
                    'semaineDebut' => $semaineCours['semaineDebut'],
                    'semaineFin' => $semaineCours['semaineFin'],
                    'contenu' => $semaineCours['contenu'],
                    'activites' => $semaineCours['activites']
                ]);
            }
            // Si la semaine de cours n'existe pas ou n'est pas associée au plan de cour actuel
            else {
                // Créer une nouvelle semaine de cours dans la base de données
                $semaineCoursModele = SemaineCours::create([
                    'semaineDebut' => $semaineCours['semaineDebut'],
                    'semaineFin' => $semaineCours['semaineFin'],
                    'contenu' => $semaineCours['contenu'],
                    'activites' => $semaineCours['activites']
                ]);
            }
            // Associer le plan de cours à la semaine de cours
            $this->semaines_cours()->save($semaineCoursModele);
            // Associer les éléments de compétences à la semaine de cours
            $semaineCoursModele->associerElementsCompetences($semaineCours['elementsCompetences']);
        }
        // Identifier les semaines de cours existantes qui ne se retrouvent pas dans la requête
        $semaineCoursManquantes = array_diff($idSemaineCoursExistants, array_column($semainesCoursRequete, 'id'));
        // Supprimer les semaines de cours existantes du plan de cours qui ne se retrouvent pas dans la requête
        SemaineCours::whereIn('id', $semaineCoursManquantes)->delete();
    }

    public function createur(){
        return $this->belongsTo(User::class, "cree_par");
    }
}
