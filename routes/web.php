<?php

//use App\Http\Controllers;

//use App\Http\Controllers\EscolaController;

use App\Http\Controllers\RelatorioController;

use App\Models\Escola;
use App\Models\Pessoal_administrativos_professore;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
      $totalfuncionarios = count(User::all());
      $totalescolas =  count(Escola::all());
      $totalProfessores =  count( Pessoal_administrativos_professore::all());
    return view('home',['funcionarios'=>$totalfuncionarios,'escolas'=>$totalescolas,'docentes'=>$totalProfessores]);
})->middleware(['auth'])->name('dashboard');

Route::get('/relatorio', function () {
    return view('relatorio');
})->middleware(['auth'])->name('relatorio');

Route::middleware(['auth'])->group( function(){
Route::get('/MatriculadosSubsistema',[RelatorioController::class,'Numero_de_Alunos_Matriculados_por_subsistema_de_Ensino'])->name('MatriculadosSubsistema');
Route::get('/GrauAproveitamento', [RelatorioController::class,'Grau_de_Aproveitamento'])->name('GrauAproveitamento');
Route::get('/professores', [RelatorioController::class,'professores_por_Subsistema_de_Ensino'])->name('professores');
Route::get('/escolas', [RelatorioController::class,'Escolas_por_Subsistema_de_Ensino'])->name('escolas');
Route::get('/MatriculadosSubsistema/{ciclo}',[RelatorioController::class,'Numero_de_Alunos_Matriculados_por_subsistema_de_Ensino']);
Route::post('/perfil/{user}',[App\Http\Controllers\UserController::class,'perfil'])->name('perfil');
Route::delete('matricula/{escola}/{classe}', [App\Http\Controllers\MatriculasController::class,'destroy'] );
Route::get('matricula/{escola}/{classe}', [App\Http\Controllers\MatriculasController::class,'editar'] );
Route::get('menu/addRole', [App\Http\Controllers\MenuController::class,'addRole'] )->name('menu.addRole');
Route::put('menu/sync', [App\Http\Controllers\MenuController::class,'sync'] )->name('menu.sync');

Route::resources([
    'user' =>  UserController::class,
    'escola' => EscolaController::class,
    'classe' => ClassesController::class,
    'ciclo' => CicloController::class,
    'disciplina' => DisciplinasController::class,
    'docente' => DocentesController::class,
    'aproveitamento' => AproveitamentosController::class,
    'documento' => DocumentosController::class,
    'matriculas' => MatriculasController::class,
    'menu' => MenuController::class,
    'funcao'=>RoleController::class,
    'permissao'=>PermissionController::class
]);
});


require __DIR__.'/auth.php';
