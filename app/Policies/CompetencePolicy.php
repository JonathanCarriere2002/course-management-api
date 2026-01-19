<?php
/* @author lebel */
namespace App\Policies;

use App\Models\Competence;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class CompetencePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // N'importe qui peut voir les détails d'une compétence
        return True;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Competence $competence): bool
    {
        // N'importe qui peut voir les compétences
        return True;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return Gate::allows('est_SRDP_ou_CP');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Competence $competence): bool
    {
        return Gate::allows('est_SRDP_ou_CP');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Competence $competence): bool
    {
        return Gate::allows('est_SRDP_ou_CP');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Competence $competence): bool
    {
        return False;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Competence $competence): bool
    {
        return False;
    }
}
