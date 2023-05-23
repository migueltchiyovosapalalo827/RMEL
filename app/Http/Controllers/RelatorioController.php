<?php

namespace App\Http\Controllers;

use App\Models\aproveitamento;
use App\Models\Classe;
use App\Models\Documento;
use App\Models\Escola;
use App\Models\Pessoal_administrativos_professore;
use App\Models\Professores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RelatorioController extends Controller
{
    protected  $aproveitamento;
    protected  $classe;
    protected  $disciplina;
    protected  $documento;
    protected  $escola;
    protected  $funcionarios;
    protected  $professores;


    public function __construct() {
    $this->aproveitamento = new aproveitamento();
    $this->documento = new Documento();
    $this->escola = new Escola();
    $this->funcionarios = new Pessoal_administrativos_professore();
    $this->professores = new Professores();

     }

     public function Numero_de_Alunos_Matriculados_por_subsistema_de_Ensino($ciclo = null)
     {
          if (!is_null($ciclo)) {
            $matricula = DB::table('matriculas')->join('ciclos','ciclos.id','=','matriculas.ciclo')
           ->where('ciclos.nome',$ciclo)
           ->select('ciclos.nome as ciclo',DB::raw('sum(matriculas.alunos) as total '))
           ->groupBy('ciclos.nome')->get();
                //return $matricula;
                 return DataTables::of($matricula)->make(true);
          }
          $matricula = DB::table('matriculas')->join('ciclos','ciclos.id','=','matriculas.ciclo')
          ->select('ciclos.nome as ciclo',DB::raw('sum(matriculas.alunos) as total '))
           ->groupBy('ciclos.nome')->get();
         return DataTables::of($matricula)->make(true);
     }

     public function Grau_de_Aproveitamento ()
     {
         # code...
         $aproveitamento =  $this->aproveitamento->join('classes','classes.id','=','aproveitamentos.classe_id')
           ->join('matriculas','matriculas.classe_id','=','classes.id')
           ->join('ciclos','ciclos.id','=','matriculas.ciclo')
           ->select('ciclos.nome as ciclo',DB::raw('sum(aproveitamentos.aprovados) as totalaprovados, sum(aproveitamentos.avaliados) as totalavaliados'))
           ->groupBy('ciclos.nome')->get();
           return DataTables::of($aproveitamento)->make(true);
     }

     public function  professores_por_Subsistema_de_Ensino()
     {
         # code...
         $rofessores =  $this->funcionarios->join('p_frente_as','pessoal_administrativos_professores.id','=','p_frente_as.pessoal_administrativos_professore_id')
           ->join('escolas','escolas.id','=','pessoal_administrativos_professores.escola_id')
           ->join('escola_ciclo','escola_ciclo.escola_id','=','escolas.id')
           ->join('ciclos','ciclos.id','=','escola_ciclo.ciclo_id')
           ->select('ciclos.nome as ciclo',DB::raw('count(p_frente_as.classe_id) as total'))
           ->groupBy('ciclos.nome')->get();
           return DataTables::of($rofessores)->make(true);
     }


     public function  Escolas_por_Subsistema_de_Ensino()
     {
         # code...
         $escola =   $this->escola
         ->join('escola_ciclo','escola_ciclo.escola_id','=','escolas.id')
         ->join('ciclos','ciclos.id','=','escola_ciclo.ciclo_id')
         ->select('ciclos.nome as ciclo',DB::raw('count(ciclos.nome) as total'))
           ->groupBy('ciclos.nome')->get();
           return DataTables::of($escola)->make(true);
     }
}

