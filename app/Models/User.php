<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Modèle représentant un utilisateur
 * @author Jonathan Carrière
 */
class User extends Authenticatable implements MustVerifyEmail
{
    // Dépendances pour le modèle des utilisateurs
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Propriétés pouvant être insérées ou mises à jour dans la base de données
     * @var string[] Liste des propriétés qui sont 'fillable'
     * @author Jonathan Carrière
     */
    protected $fillable = [
        'name',
        'firstname',
        'email',
        'email_verified_at',
        'password',
        'role',
        'bureau',
        'poste'
    ];

    /**
     * Propriétés qui doivent être sérialisées
     * @var string[] Liste des propriétés qui doivent obligatoirement être sérialisées
     * @author Jonathan Carrière
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Propriétés qui doivent être transformées en d'autres types
     * @var string[] Liste des propriétés qui doivent obligatoirement être transformées en d'autres types
     * @author Jonathan Carrière
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relation entre un utilisateur et son rôle
     * @return BelongsTo Un utilisateur appartient à un rôle
     * @author Jonathan Carrière
     */
    public function roleUtilisateur():belongsTo {
        return $this->belongsTo(Role::class, 'role');
    }

    /**
     * Méthode qui définit une relation "Many-to-Many" entre User et Programme.
     * @return BelongsToMany Les programmes associés au user (BelongsToMany)
     * @author Emeric Chauret
     */
    public function programmes(): BelongsToMany {
        return $this->belongsToMany(Programme::class);
    }

    /**
     * Méthode qui permet d'associer des programmes au user.
     * @param array $programmes_ids Les identifiants des programmes à lier au user (array)
     * @author Emeric Chauret
     */
    public function associer_programmes($programmes_ids): void {
        $a = array_map(fn($programme_id) => $programme_id['id'], $programmes_ids);
        $this->programmes()->sync($a);
        $this->save();
    }

    /**
     * Fonction permettant d'associer les programmes à un utilisateur dans le seeder
     * @author Jonathan Carrière
     */
    public function associerProgrammesSeeder($programmes): void {
        $this->programmes()->sync($programmes);
        $this->save();
    }

}
