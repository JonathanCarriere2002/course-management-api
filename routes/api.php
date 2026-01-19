<?php

use App\Http\Controllers\Approbation\ApprobationController;
use App\Http\Controllers\Auth\APIAuthController;
use App\Http\Controllers\Auth\Breeze\NewPasswordController;
use App\Http\Controllers\Auth\Breeze\PasswordResetLinkController;
use App\Http\Controllers\CampusControllers\CampusController;
use App\Http\Controllers\EnseignantController\EnseignantController;
use App\Http\Controllers\GabaritControllers\GabaritController;
use App\Http\Controllers\PlanCoursController\PlanCoursController;
use App\Http\Controllers\PlansCadresControllers\CompetencesControllers\CompetencesController;
use App\Http\Controllers\PlansCadresControllers\CompetencesControllers\CriteresPerformanceController;
use App\Http\Controllers\PlansCadresControllers\CompetencesControllers\ElementsCompetenceController;
use App\Http\Controllers\PlansCadresControllers\CriteresEvaluationsController;
use App\Http\Controllers\PlansCadresControllers\PlansCadresController;
use App\Http\Controllers\ProgrammeController\ProgrammeController;
use App\Http\Controllers\RoleController\RoleController;
use App\Http\Controllers\SectionControllers\SectionController;
use App\Http\Controllers\SessionController\SessionController;
use App\Http\Controllers\TypeSectionControllers\TypeSectionController;
use App\Http\Controllers\UserController\UserController;
use App\Http\Resources\UserResources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Routes pour la gestion de l'authentification
 */
Route::group(['middleware' => ['guest']], function(){
    Route::post('/login',[APIAuthController::class, 'login']);
    Route::post('/forgot-password',[PasswordResetLinkController::class, 'store']);
    Route::post('/reset-password',[NewPasswordController::class, 'store']);
    Route::get('/reset-password',[NewPasswordController::class, 'store']);
    // Cette route est désactivée, car seulement un administrateur va pouvoir créer des comptes
    // Route::post('/register', [RegisteredUserController::class, 'store']);
});

/**
 * Routes pour accéder aux ressources de l'API
 */

Route::group(['middleware' => ['auth:sanctum', 'verified']], function (){
    Route::post('/logout',[APIAuthController::class, 'logout']);
    Route::get('/user', function (Request $request) { return new UserResource($request->user());});
    Route::apiResource('/plans-cadres', PlansCadresController::class);
    Route::get('/plans-cadres/programme/{programmeId}', [PlansCadresController::class, 'indexParProgramme']);
    Route::apiResource('/criteres-evaluation', CriteresEvaluationsController::class);
    Route::apiResource('/competences', CompetencesController::class);
    Route::apiResource('/elements-competence', ElementsCompetenceController::class);
    Route::apiResource('/criteres-performance', CriteresPerformanceController::class);
    Route::apiResource('/programmes', ProgrammeController::class);
    // @author Jonathan Carrière
    Route::apiResource('/enseignants', EnseignantController::class);
    Route::apiResource('/roles', RoleController::class);
    Route::apiResource('/sessions', SessionController::class);
    Route::apiResource('/utilisateurs', UserController::class);
    Route::patch('/plans-cours/approbation/{id}/{date}', [ApprobationController::class, 'updatePlanCoursApprobation']);
    Route::patch('/plans-cours/approbation-supprimer/{id}', [ApprobationController::class, 'deletePlanCoursApprobation']);
    Route::patch('/plans-cadres/approbation/{id}/{date}/{statut}', [ApprobationController::class, 'updatePlanCadreApprobation']);
    Route::patch('/plans-cadres/approbation-supprimer/{id}/{statut}', [ApprobationController::class, 'deletePlanCadreApprobation']);
    // @author Emeric Chauret
    Route::apiResource('/programmes/{programme_id}/plans-cours', PlanCoursController::class);
    Route::apiResource('/sections', SectionController::class);
    Route::apiResource('/campus', CampusController::class);
    Route::apiResource('/gabarits', GabaritController::class);
    Route::apiResource('/types-section', TypeSectionController::class);
});

/**
 * Routes pour accéder aux ressources de l'API avec une exigence d'authentification
 */
Route::group(['middleware' => ['auth:sanctum', 'verified']], function (){

});
