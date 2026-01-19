<?php

namespace App\Http\Controllers\Approbation;

use App\Http\Controllers\BaseController;
use App\Models\PlanCadre;
use App\Models\PlanCours;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

/**
 * Contrôleur permettant d'effectuer l'approbation des plans-cadre et des plans de cours
 * @author Jonathan Carrière
 */
class ApprobationController extends BaseController
{

    /**
     * Méthode permettant de mettre à jour la date d'approbation d'un plan de cours
     * @param string $id Id du plan de cours qui sera approuvé
     * @param string $date Date de l'approbation du plan de cours
     * @return JsonResponse Réponse contenant la date mise à jour du plan de cours
     */
    public function updatePlanCoursApprobation(string $id, string $date): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_coordonnateur');
        // Obtenir le plan de cours de la base de données en utilisant son Id
        $planCours = PlanCours::find($id);
        // Vérifier si le plan de cours ayant l'Id spécifiée existe
        if ($planCours) {
            // Vérifier si la date d'approbation pour le plan de cours est valide en utilisant Carbon
            // Utilisation des méthodes 'lte' (less than) pour vérifier si la date est inférieur à demain et 'gt' (greater than) pour vérifier si la date est au moins 1967
            // Source : https://carbon.nesbot.com/docs/
            if (Carbon::parse($date, 'America/Toronto')->lte(Carbon::today('America/Toronto')) && Carbon::parse($date, 'America/Toronto')->gt(Carbon::createFromDate(1967, 1, 1, 'America/Toronto'))) {
                // Mettre à jour la date d'approbation du plan de cours
                $planCours->update(['approbation' => $date]);
                // Retourner le plan de cours avec la date mise à jour
                return $this->sendResponse($date, 201);
            }
        }
        // Si une erreur se produit lors de l'approbation, retourner une erreur
        return $this->sendError("La date d'approbation du plan de cours n'a pas pu être mise à jour.");
    }

    /**
     * Méthode permettant de supprimer la date d'approbation d'un plan de cours
     * @param string $id Id du plan de cours dont l'approbation sera supprimé
     * @return JsonResponse Réponse contenant le statut de la suppression de l'approbation
     */
    public function deletePlanCoursApprobation(string $id): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate'
        Gate::authorize('est_admin_ou_coordonnateur');
        // Obtenir le plan de cours de la base de données en utilisant son Id
        $planCours = PlanCours::find($id);
        // Vérifier si le plan de cours ayant l'Id spécifiée existe
        if ($planCours) {
            // Vérifier si la date d'approbation pour le plan de cours n'est pas null
            if ($planCours->approbation !== null) {
                // Supprimer la date d'approbation du plan de cours
                $planCours->update(['approbation' => null]);
                // Retourner un message permettant de confirmer que l'approbation a été supprimée
                return $this->sendResponse("La date d'approbation du plan de cours a été supprimée.", 201);
            }
        }
        // Si une erreur se produit lors de la suppression, retourner une erreur
        return $this->sendError("La date d'approbation du plan de cours n'a pas pu être supprimée.");
    }

    /**
     * Méthode permettant de mettre à jour la date d'approbation d'un plan-cadre
     * @param string $id Id du plan-cadre qui sera approuvé
     * @param string $date Date de l'approbation du plan-cadre
     * @param string $statut Statut de l'approbation du plan-cadre
     * @return JsonResponse Réponse contenant la date mise à jour du plan-cadre
     */
    public function updatePlanCadreApprobation(string $id, string $date, string $statut): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate' différent selon le statut de l'approbation à effectuer
        switch ($statut) {
            // Si le plan-cadre est approuvé par le comité ou le programme, seulement un admin ou coordonnateur est autorisé
            case 'comite':
            case 'departement':
                Gate::authorize('est_admin_ou_coordonnateur');
                break;
            // Si le plan-cadre est déposé à la direction des études, seulement un admin, un CP ou un SRDP est autorisé
            case 'direction':
                Gate::authorize('est_admin_ou_cp_ou_srdp');
                break;
            // Si l'utilisateur ne possède aucun de ces rôles une erreur 403 est lancée
            default:
                abort(403, 'Vous ne possédez pas les permissions requises pour approuver un plan-cadre.');
        }
        // Obtenir le plan-cadre de la base de données en utilisant son Id
        $planCadre = PlanCadre::find($id);
        // Convertir la date en utilisant Carbon
        $date = Carbon::parse($date, 'America/Toronto');
        // Vérifier si le plan-cadre ayant l'Id spécifiée existe
        if ($planCadre) {
            // Vérifier si la date d'approbation pour le plan-cadre est valide en utilisant Carbon
            // Utilisation des méthodes 'lte' (less than) pour vérifier si la date est inférieur à demain et 'gt' (greater than) pour vérifier si la date est au moins 1967
            // Source : https://carbon.nesbot.com/docs/
            if ($date->lte(Carbon::today('America/Toronto')) && $date->gt(Carbon::createFromDate(1967, 1, 1, 'America/Toronto'))) {
                // Vérifier si le plan-cadre se fait approuver par le département
                if ($statut === "departement") {
                    // Vérifier si la date d'approbation par le département est inférieur ou égale aux dates d'approbation par le comité et la direction
                    if (($date <= Carbon::parse($planCadre->dateApprobationComiteProgrammes, 'America/Toronto')) && ($date <= Carbon::parse($planCadre->dateDepotDirectionEtudes, 'America/Toronto'))) {
                        // Mettre à jour la date d'approbation par le département et retourner une réponse
                        $planCadre->update(['dateApprobationDepartement' => $date]);
                        return $this->sendResponse($date, 201);
                    }
                }
                // Vérifier si le plan-cadre se fait approuver par le comité de programme
                if ($statut === "comite") {
                    // Vérifier si la date d'approbation par le département n'est pas null
                    if ($planCadre->dateApprobationDepartement !== null) {
                        // Vérifier si la date d'approbation par le comité est supérieur ou égale à l'approbation par le département et inférieur ou égale à l'approbation par la direction
                        if (($date >= Carbon::parse($planCadre->dateApprobationDepartement, 'America/Toronto')) && ($date <= Carbon::parse($planCadre->dateDepotDirectionEtudes, 'America/Toronto'))) {
                            // Mettre à jour la date d'approbation par le comité de programme et retourner une réponse
                            $planCadre->update(['dateApprobationComiteProgrammes' => $date]);
                            return $this->sendResponse($date, 201);
                        }
                    }
                }
                // Vérifier si le plan-cadre se fait approuver par la direction des études
                if ($statut === "direction") {
                    // Vérifier si les dates d'approbation par le département et par le comité ne sont pas null
                    if ($planCadre->dateApprobationDepartement !== null && $planCadre->dateApprobationComiteProgrammes !== null) {
                        // Vérifier si la date d'approbation par la direction des études est supérieur ou égale aux dates d'approbation par le département et le comité
                        if (($date >= Carbon::parse($planCadre->dateApprobationDepartement, 'America/Toronto')) && ($date >= Carbon::parse($planCadre->dateApprobationComiteProgrammes, 'America/Toronto'))) {
                            // Mettre à jour la date d'approbation par la direction des études et retourner une réponse
                            $planCadre->update(['dateDepotDirectionEtudes' => $date]);
                            return $this->sendResponse($date, 201);
                        }
                    }
                }
            }
        }
        // Si une erreur se produit lors de l'approbation, retourner une erreur
        return $this->sendError("La date d'approbation du plan-cadre n'a pas pu être mise à jour.");
    }

    /**
     * Méthode permettant de supprimer une date d'approbation d'un plan-cadre
     * @param string $id Id du plan-cadre dont l'approbation sera supprimée
     * @param string $statut Statut de l'approbation du plan-cadre qui sera supprimée
     * @return JsonResponse Réponse contenant le statut de la suppression de l'approbation
     */
    public function deletePlanCadreApprobation(string $id, string $statut): JsonResponse
    {
        // Vérification du rôle de l'utilisateur avec un 'Gate' différent selon le statut de l'approbation à effectuer
        switch ($statut) {
            // Si le plan-cadre est approuvé par le comité ou le programme, seulement un admin ou coordonnateur est autorisé
            case 'comite':
            case 'departement':
                Gate::authorize('est_admin_ou_coordonnateur');
                break;
            // Si le plan-cadre est déposé à la direction des études, seulement un admin, un CP ou un SRDP est autorisé
            case 'direction':
                Gate::authorize('est_admin_ou_cp_ou_srdp');
                break;
            // Si l'utilisateur ne possède aucun de ces rôles une erreur 403 est lancée
            default:
                abort(403, 'Vous ne possédez pas les permissions requises pour approuver un plan-cadre.');
        }
        // Obtenir le plan-cadre de la base de données en utilisant son Id
        $planCadre = PlanCadre::find($id);
        // Vérifier si le plan-cadre ayant l'Id spécifiée existe
        if ($planCadre) {
            // Vérifier si l'approbation par le département est supprimée
            if ($statut === "departement") {
                // Vérifier que l'approbation par le département n'est pas null et que le plan-cadre n'a pas été approuvé par le comité de programme ou la direction des études
                if ($planCadre->dateApprobationDepartement !== null && $planCadre->dateApprobationComiteProgrammes === null && $planCadre->dateDepotDirectionEtudes === null) {
                    // Supprimer la date d'approbation par le département et retourner une réponse
                    $planCadre->update(['dateApprobationDepartement' => null]);
                    return $this->sendResponse("La date d'approbation du plan-cadre par le département a été supprimée.", 201);
                }
            }
            // Vérifier si l'approbation par le comité de programme est supprimée
            if ($statut === "comite") {
                // Vérifier que l'approbation par le département et par le comité de programme ne sont pas null et que le plan-cadre n'a pas été approuvé par la direction des études
                if ($planCadre->dateApprobationDepartement !== null && $planCadre->dateApprobationComiteProgrammes !== null && $planCadre->dateDepotDirectionEtudes === null) {
                    // Supprimer la date d'approbation par le comité de programme et retourner une réponse
                    $planCadre->update(['dateApprobationComiteProgrammes' => null]);
                    return $this->sendResponse("La date d'approbation du plan-cadre par le comité de programme a été supprimée.", 201);
                }
            }
            // Vérifier si l'approbation par la direction des études est supprimée
            if ($statut === "direction") {
                // Vérifier que l'approbation par le département, par le comité de programme et par la direction des études ne sont pas null
                if ($planCadre->dateApprobationDepartement !== null && $planCadre->dateApprobationComiteProgrammes !== null && $planCadre->dateDepotDirectionEtudes !== null) {
                    // Supprimer la date d'approbation par la direction des études et retourner une réponse
                    $planCadre->update(['dateDepotDirectionEtudes' => null]);
                    return $this->sendResponse("La date d'approbation du plan-cadre par la direction des études a été supprimée.", 201);
                }
            }
        }
        // Si une erreur se produit lors de la suppression, retourner une erreur
        return $this->sendError("La date d'approbation du plan-cadre n'a pas pu être supprimée.");
    }

}
