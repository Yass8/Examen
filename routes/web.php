<?php

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\parametre;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\CandidatController;

// require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $listeTroi = DB::table('releves')
    ->join('candidats','releves.candidat_id','=','candidats.id')
    ->where('releves.classe_id',4)
    ->select('releves.*','candidats.*')
    ->orderBy('candidats.nom_candidat','ASC')
    ->get();
    $listeBac = DB::table('releves')
    ->join('candidats','releves.candidat_id','=','candidats.id')
    ->where('releves.classe_id','!=',4)
    ->select('releves.*','candidats.*')
    ->orderBy('candidats.nom_candidat','ASC')
    ->get();
    return view('examen.dashboard',compact('listeTroi','listeBac'));
})->name('dashboard');

Route::get('/dashboardl', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboardl');

// require __DIR__.'/auth.php';

Route::resource('/examens',ExamController::class);
Route::get('/examList',[ExamController::class, 'liste'])->name('exam');

Route::resource('/matieres',MatiereController::class);
Route::get('/getMatieresByExam/{id}', [MatiereController::class, 'getMatieresByExam']);

Route::resource('/candidats',CandidatController::class);
Route::get('/getCandidats/{id}', [CandidatController::class, 'getCandidats']);

Route::resource('/classes',ClasseController::class);
Route::get('/classeList', [ClasseController::class, 'classeList']);
Route::get('/getClassesByExam/{id}', [ClasseController::class, 'getClassesByExam']);

Route::resource('/notes',NoteController::class);

Route::get('/note/{note_id}/{candidat_id}',[NoteController::class,'suppression']);


Route::get('/parametre', [parametre::class, 'index'])->name('parametre');
Route::get('/parametre/show', [parametre::class, 'show'])->name('parametre.show');
Route::post('/etablissement/edit', [parametre::class, 'edit'])->name('etablissement.edit');


// Route::get('/parametre', function()
// {
//     return view('examen.parametre');
// })->name("parametre");
