<?php

/**
 * @author Jacob Beauregard-Tousignant
 */


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class PlanCadre extends Model
{
    protected $table = "plans_cadres";

    use HasFactory;

    protected $fillable = [
        'code',
        'titre',
        'ponderation',
        'unites',
        'attitudes',
        'intentionsEducatives',
        'descCours',
        'dateApprobationDepartement',
        'dateApprobationComiteProgrammes',
        'dateDepotDirectionEtudes',
        'changement',
        'ponderationFinale',
        'intentionsPedagogiques',
        'pagesdevisIntentionsEducatives',
        'anneesdevisIntentionsEducatives'
    ];


    /**
     * Realation prise du projet PHP finale de Jacob de H23
     */
    public function plans_cadres(): belongsToMany{
        return $this->belongsToMany(PlanCadre::class, 'plan_cadre_plan_cadre', 'id_plan_cadre1', 'id_plan_cadre2')->withPivot('typeRelation');
    }

    /**
     * Méthode permettant d'attacher un nouveau plan cadre et faire leur relation avec l'attribut pivot
     * @param PlanCadre $planCadre Le plan cadre à attacher au plan cadre
     * @param string $typeRelation Le type de relation à mettre en attribut pivot (préalable absolu, préalable relatif ou corequis)
     * @return void
     * Méthode prise du projet final de PHP de Jacob de H23
     */
    public function ajouterPlanCadre(PlanCadre $planCadre, string $typeRelation):void{
        $this->plans_cadres()->attach([
            $planCadre->id => ['typeRelation'=>$typeRelation]
        ]);
        $this->save();
    }


    /**
     * Méthode pour ajouter un préalable relatif au plan cadre
     * @param PlanCadre $planCadre Le plan cadre qui est le préalable relatif
     * @return void
     */
    public function ajouterPlanCadrePrealableRelatif(int $planCadreId):void{
        $this->plans_cadres()->attach([
            $planCadreId => ['typeRelation'=>'prealable relatif']
        ]);
        $this->save();
    }


    /**
     * Attribut donnant les plans cadres préalable relatif
     * @return BelongsToMany
     */
    public function getPlansCadresRelatifsAttribute(){
        return $this->plans_cadres->where('pivot.typeRelation', '=', 'prealable relatif');
    }

    /**
     * Méthode pour ajouter un plan cadre préalable absulu
     * @param PlanCadre $planCadre Le plan cadre qui est le préalable absolu
     * @return void
     */
    public function ajouterPlanCadrePrealableAbsolu(int $planCadreId):void{
        $this->plans_cadres()->attach([
            $planCadreId => ['typeRelation'=>'prealable absolu']
        ]);
        $this->save();
    }


    /**
     * Attribut donnant l'ensemble des plans cadres préalables relatifs
     * @return BelongsToMany
     */
    public function getPlansCadresAbolusAttribute(){
        return $this->plans_cadres->where('pivot.typeRelation', '=', 'prealable absolu');
    }


    /**
     * Méthode pour ajouter des plans cadres corequis
     * @param PlanCadre $planCadre Le plan cadre corequis
     * @return void
     */
    public function ajouterPlanCadreCorequis(int $planCadreId):void{
        $this->plans_cadres()->attach([
            $planCadreId => ['typeRelation'=>'corequis']
        ]);
        $this->save();
    }


    /**
     * Attribut donnant l'ensemble des plans cadres corequis
     * @return BelongsToMany
     */
    public function getPlansCadresCorequisAttribute(){
        return $this->plans_cadres->where('pivot.typeRelation', '=', 'corequis');
    }


    /**
     * Méthode pour ajouter un plan cadre suivant
     * @param PlanCadre $planCadre Le plan cadre suivant
     * @return void
     */
    public function ajouterPlanCadreSuivant(int $planCadreId):void{
        $this->plans_cadres()->attach([
            $planCadreId => ['typeRelation'=>'suivant']
        ]);
        $this->save();
    }


    /**
     * Attribut donnant l'ensemble des plans cadres suivant
     * @return Collection
     */
    public function getPlansCadresSuivantsAttribute(){
        return $this->plans_cadres->where('pivot.typeRelation', '=', 'suivant');
    }


    /**
     * Méthode pour enlever un plan cadre en relation avec celui-ci
     * @param int $planCadreId L'Id du plan cadre à enlever
     * @return void
     * Méthode prise du projet final de PHP de Jacob de H23
     */
    public function enleverPlanCadre(int $planCadreId):void{
        $this->plans_cadres()->detach([
            $planCadreId
        ]);
        $this->save();
    }

    public function enleverPlusieursPlanCadre(Collection $plansCadres):void{
        $this->plans_cadres()->detach(
            $plansCadres
        );
        $this->save();
    }


    /**
     * Méthode de la relation entre les plans cadres et les compétences
     * @return belongsToMany
     */
    public function competence():belongsToMany{
        return $this->belongsToMany(Competence::class, 'competences_plans_cadre')->withPivot('ContexteLocal', 'Atteinte', 'Completion');
    }


    /**
     * Méthode pour ajouter une liaison avec une compétence partiellement couverte et les pivots,
     * le contexte local et la complétion (X de Y)
     * @param Competence $competence
     * @param string $ContexteLocal
     * @param string $Completion
     * @return void
     */
    public function ajouter_competence_partielle(Competence $competence, string $ContexteLocal, string $Completion){
        $this->competence()->attach([
            $competence->id =>['ContexteLocal'=>$ContexteLocal, 'Atteinte'=>"Partielle", 'Completion'=>$Completion]
        ]);
        $this->save();
    }

    /**
     * Méthode pour ajouter une liaison avec une compétence completement couverte et les pivots,
     * le contexte local, l'atteinte (complète ou partielle) et la complétion (X de Y)
     * @param Competence $competence
     * @param string $ContexteLocal
     * @return void
     */
    public function ajouter_competence_complete(Competence $competence, string $ContexteLocal){
        $this->competence()->attach([
            $competence->id =>['ContexteLocal'=>$ContexteLocal, 'Atteinte'=>"Complète"]
        ]);
        $this->save();
    }


    /**
     * Méthode pour enlever une compétence d'un plan cadre
     * @param string $competenceId L'Id de la compétence à enlever
     * @return void
     */
    public function enlever_competence(string $competenceId){
        $this->competence()->detach([
            $competenceId
        ]);
    }



    /**
     * TODO: Vérifier l'ordre des clé, est-ce que la première est celle de critère ou d'élément de compétence?
     * Méthode pour la relation entre les plans cadres et les critères d'évaluations pour les contenus locaux
     * @return BelongsToMany
     */
    public function element_competence():belongsToMany{
        return $this->belongsToMany(ElementCompetence::class, 'element_competence_plan_cadre', 'id_plan_cadre', 'id_element_compe')->withPivot('contenu_local');
    }

    /**
     * Méthode pour ajouter un élément de compétence et son contenu local au plan cadre
     * @param ElementCompetence $elementCompetence L'élément de compétence à attacher
     * @param string $contenuLocal Le contenu local
     * @return void
     */
    public function ajouterElementCompetence(int $elementCompetenceId, string $contenuLocal){
        $this->element_competence()->attach([
            $elementCompetenceId => ['contenu_local'=>$contenuLocal]
        ]);
        $this->save();
    }

    /**
     * Méthode pour enlever un élément de compétence du plan cadre
     * @param string $elementCompetenceId L'id de l'élément de compétence à supprimer
     * @return void
     */
    public function enleverElementCompetence(string $elementCompetenceId){
        $this->element_competence()->detach([
            $elementCompetenceId
        ]);
        $this->save();
    }


    /**
     * Relation entre le plan cadre et ses critères d'évaluation
     * @return HasMany
     */
    public function criteres_evaluations():hasMany{
        return $this->hasMany(CritereEvaluation::class,"plan_cadre_id");
    }


    /**
     * Relation entre le plan cadre et la session disant quand le plan cadre entre en vigueur
     * @return BelongsTo
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class, "session_id");
    }

    /**
     * Méthode pour ajouter une session au plan cadre représentant quand le plan cadre entre en vigueur
     * @param $session
     * @return void
     */
    public function associer_session($session){
        $this->session()->associate($session);
        $this->save();
    }


    /**
     * Méthode pour dissocier la session d'un plan cadre
     * @return void
     */
    public function dissocier_session(){
        $this->session()->dissociate();
        $this->save();
    }


    /**
     * Relation entre le plan cadre et son programme
     * @return BelongsTo
     */
    public function programme(): BelongsTo
    {
        return $this->belongsTo( Programme::class, "programme_id");
    }

    /**
     * Méthode pour associer un programme au plan cadre
     * @param $programmeId L'id du programme à associer
     * @return void
     */
    public function associer_programme($programme){
        $this->programme()->associate($programme);
        $this->save();
    }


    /**
     * Méthode pour dissocier le plan cadre de la session
     * @return void
     */
    public function dissocier_programme(){
        $this->programme()->dissociate();
        $this->save();
    }

    /**
     * Méthode pour récupérer les éléments des compétences associées au plan-cadre.
     * @return array la liste des identifiants des éléments de compétence des compétences associées au plan-cadre (Collection)
     * @author Emeric Chauret
     */
    public function elements_competences_ids(): array {
        return $this->competence->flatMap(function ($competence) {
            return $competence->elements_competences->pluck('id');
        })->toArray();
    }




    /**
     * Méthode qui définit une relation "One-to-Many" entre plan-cadre et Gabarit
     * @return BelongsTo le gabarit associé au plan-cadre
     * @authors Jacob Beauregard-Tousignant, Emeric Chauret
     */
    public function gabarit(): BelongsTo {
        return $this->belongsTo(Gabarit::class, 'gabarit_id');
    }

    /**
     * Méthode qui permet d'associer un gabarit au plan-cadre.
     * @param $gabarit_id l'identifiant du gabarit à associer au plan-cadre
     * @return void
     * @authors Jacob Beauregard-Tousignant, Emeric Chauret
     */
    public function associer_gabarit($gabarit_id): void {
        $this->gabarit()->associate($gabarit_id);
        $this->save();
    }




    /**
     * Méthode qui définit une relation "Many-to-Many" entre Plan-cadre et Section.
     * @return BelongsToMany les sections associées au plan-cadre
     * @authors Jacob Beauregard-Tousignant, Emeric Chauret
     */
    public function sections(): BelongsToMany {
        return $this->belongsToMany(Section::class, 'plan_cadre_section')->withPivot(['texte', 'info_suppl']);
    }

    /**
     * Méthode qui retourne la liste des sections du plan-cadre selon l'ordre du gabarit.
     * @return Collection les sections du plan-cadre selon l'ordre du gabarit
     * @authors Jacob Beauregard-Tousignant, Emeric Chauret
     */
    public function sections_en_ordre(): Collection {
        return $this->gabarit->sections->map(function($section) {
            return $this->sections->find($section->id);
        });
    }

    /**
     * Méthode qui permet d'associer des sections au plan-cadre.
     * @param $sections
     * @return void
     * @authors Jacob Beauregard-Tousignant, Emeric Chauret
     */
    public function associer_sections($sections): void {
        $a = array_combine(array_map(fn($section) => $section['id'], $sections),
            array_map(fn($section) => ['texte' => $section['texte'], 'info_suppl' => $section['info_suppl']] , $sections));
        $this->sections()->sync($a);
        $this->save();
    }
}
