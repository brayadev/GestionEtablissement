<?php


use App\Http\Controllers\ClasseController;
use Illuminate\Support\Facades\Route;

// Page d'accueil (redirige vers la page de connexion)
Route::get('/', function () {
    return redirect('/login');
});

// Page de connexion
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Page listEtudiant (protégée par authentification)
Route::middleware('auth')->group(function () {
    Route::get('/listEtudiant', [\App\Http\Controllers\EtudiantController::class, 'index'])->name('listEtudiant');
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});


//les routes de classes
Route::get('/creerClasse', [ClasseController::class, 'create'])->name('creerClasse');
Route::post('/enregistrerClasse', [ClasseController::class, 'store'])->name('enregistrerClasse');
Route::get('/listClasse', [ClasseController::class, 'index'])->name('listClasse');
Route::delete('/supprimerClasse/{id}', [ClasseController::class, 'destroy'])->name('supprimerClasse');
// Gestion des cours par classe
use App\Http\Controllers\ClasseCourseController;
//les routes de classe cours
Route::get('/classes/{id}/cours', [ClasseCourseController::class, 'edit'])->name('editCoursClasse');
Route::post('/classes/{id}/cours', [ClasseCourseController::class, 'update'])->name('updateCoursClasse');
Route::get('/listClasseCours', [ClasseCourseController::class, 'index'])->name('listClasseCours');


//les routes de professeur
Route::get('/creerProf', [\App\Http\Controllers\ProfesseurController::class, 'create'])->name('creerProf');
Route::post('/enregistrerProf', [\App\Http\Controllers\ProfesseurController::class, 'store'])->name('enregistrerProf');
Route::get('/listProf', [\App\Http\Controllers\ProfesseurController::class, 'index'])->name('listProf');
Route::delete('/supprimerProf/{id}', [\App\Http\Controllers\ProfesseurController::class, 'destroy'])->name('supprimerProf');
//les routes d'etudiant
Route::get('/creerEtudiant', [\App\Http\Controllers\EtudiantController::class, 'create'])->name('creerEtudiant');
Route::post('/enregistrerEtudiant', [\App\Http\Controllers\EtudiantController::class, 'store'])->name('enregistrerEtudiant');
Route::get('/listEtudiant', [\App\Http\Controllers\EtudiantController::class, 'index'])->name('listEtudiant');
//Route::get('/listEtudiant', [\App\Http\Controllers\EtudiantController::class, 'index'])->name('listEtudiant');
Route::delete('/supprimerEtudiant/{id}', [\App\Http\Controllers\EtudiantController::class, 'destroy'])->name('supprimerEtudiant');
//les routes de cours
Route::get('/creerCours', [\App\Http\Controllers\CoursController::class, 'create'])->name('creerCours');
Route::post('/enregistrerCours', [\App\Http\Controllers\CoursController::class, 'store'])->name('enregistrerCours');
Route::get('/listCours', [\App\Http\Controllers\CoursController::class, 'index'])->name('listCours');
Route::delete('/supprimerCours/{id}', [\App\Http\Controllers\CoursController::class, 'destroy'])->name('supprimerCours');

