<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\GradoController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PlantillaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('plantilla.index');
});

Route::resource('plantilla',PlantillaController::class)->names('plantilla');
Route::resource('cursos',CursoController::class)->names('cursos');
Route::get('cursos/{plantilla}/crearcurso', [CursoController::class, 'crearcurso'])->name('cursos.crearcurso');
Route::post('curso/{plantilla}/store2', [CursoController::class, 'store2'])->name('cursos.store2');
Route::resource('users',UserController::class)->names('users');
Route::post('users/consulta', [UserController::class, 'consulta'])->name('users.consulta');
Route::resource('periodos',PeriodoController::class)->names('periodos');
Route::get('periodo/{periodo}/consultargrados', [PeriodoController::class, 'consultargrados'])->name('periodo.consultargrados');
Route::resource('grados',GradoController::class)->names('grados');
Route::get('grado/{periodo}/creargrado', [GradoController::class, 'crearGrado'])->name('grado.creargrado');
Route::post('grado/{periodo}/store2', [GradoController::class, 'store2'])->name('grado.store2');
Route::resource('areas',AreaController::class)->names('areas');
Route::get('grado/{grado}/consultarmatricula',[GradoController::class,'consultarmatricula'])->name('grado.consultarmatricula');
Route::post('grado/{grado}/matricular', [GradoController::class, 'matricular'])->name('grado.matricular');
Route::post('grado/{grado}/desmatricular', [GradoController::class, 'desmatricular'])->name('grado.desmatricular');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
