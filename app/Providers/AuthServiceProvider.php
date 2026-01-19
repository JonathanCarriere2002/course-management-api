<?php

namespace App\Providers;

use App\Models\PlanCours;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

/**
 * Fichier permettant de définir les gates utilisés dans les politiques et de lier des politiques aux modèles
 * @author Emeric Chauret
 * @author Jonathan Carrière
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * Liaison entre les modèles et leur politique
     */
    protected $policies = [
        'App\Models\Programme' => 'App\Policies\ProgrammePolicy'
    ];

    /**
     * Définir les gates utilisés par les politiques des modèles
     */
    public function boot(): void
    {
        // Enregistrer les politiques de l'application
        $this->registerPolicies();

        /**
         * Méthode permettant de générer l'URL utilisé pour la réinitialisation des mots de passe
         */
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url')."/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        /**
         * Vérifie si l'utilisateur peut consulter la liste des plans de cours ou un plan de cours d'un programme.
         * @author Emeric Chauret
         */
        Gate::define('peut_afficher_plan_cours', function (User $user, string $programme_id){
            return in_array($user->role, [1, 2, 3]) || (in_array($user->role, [4, 5]) && in_array($programme_id, $user->programmes->pluck('id')->toArray()));
        });

        /**
         * Vérifie si l'utilisateur peut modifier ou supprimer un plan de cours dans un programme.
         * @author Emeric Chauret
         */
        Gate::define('peut_modifier_ou_supprimer_plan_cours', function (User $user, int $programme_id, PlanCours $plancours){
            return $user->role == 1 || (in_array($user->role, [4, 5]) && in_array($programme_id, $user->programmes->pluck('id')->toArray()) && $user->id == $plancours->cree_par);
        });

        /**
         * Vérifie si l'utilisateur peut créer un plan de cours dans un programme.
         * @author Emeric Chauret
         */
        Gate::define('peut_creer_plan_cours', function (User $user, int $programme_id){
            return $user->role == 1 || (in_array($user->role, [4, 5]) && in_array($programme_id, $user->programmes->pluck('id')->toArray()));
        });

        /**
         * Vérifie si l'utilisateur est un admin, un cp ou un srdp.
         * @author Emeric Chauret
         */
        Gate::define('est_admin_ou_cp_ou_srdp', function (User $user){
            return in_array($user->role, [1, 2, 3]);
        });

        /**
         * Vérifie si l'utilisateur est un admin
         * @author Jonathan Carrière
         */
        Gate::define('est_admin', function (User $user) {
            return $user->role == 1;
        });

        /**
         * Vérifie si l'utilisateur est un admin ou un coordonnateur
         * @author Jonathan Carrière
         */
        Gate::define('est_admin_ou_coordonnateur', function (User $user) {
            return in_array($user->role, [1, 4]);
        });

        /**
         * Vérifie si l'utilisateur est un admin, un CP, un SRDP ou un coordonnateur
         * @author Jonathan Carrière
         */
        Gate::define('est_admin_ou_cp_ou_srdp_ou_coordonnateur', function (User $user) {
            return in_array($user->role, [1, 2, 3, 4]);
        });

        /**
         * Vérifier si l'utilisateur est authentifié.
         * @author Emeric Chauret
         */
        Gate::define('est_authentifie', function (User $user) {
            return in_array($user->role, [1, 2, 3, 4, 5]);
        });

    }

}
