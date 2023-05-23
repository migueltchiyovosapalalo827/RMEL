<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Disciplina;
use App\Models\Escola;
use App\Models\Pessoal_administrativos_professore;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DocentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

    if ($request->ajax()) {
            $data =  DB::table('pessoal_administrativos_professores')
            ->join('escolas', 'pessoal_administrativos_professores.escola_id', '=', 'escolas.id')
        ->select( 'escolas.nomeescola', 'pessoal_administrativos_professores.*')
        ->latest()->get();
            return  Datatables::of($data)->make(true);
        }

        return view('docentes.index');




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $escolas = Escola::all();
        $disciplinas = Disciplina::all();
        $classes  = Classe::all();

        return view('docentes.create',['escolas'=>$escolas,'disciplinas'=>$disciplinas,
         'classes'=>$classes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validationRules =  [
            'nome' => 'required|min:6|max:100',
            'instituicao' => 'required|min:6|max:100',
            'datainicio'=>'required|date',
            'nivelacademico'=>'required',
            'contacto'=>'required|min:9|max:12',
            'cargahoraria'=>'required',
            'categoria'=>'required|min:4',
            'numeroINSS'=>'required|min:4',
            'numeroagente'=>'required|min:4',
            'sexo'=>'required',
            'bi' => 'required|min:14|regex:/^[0-9]{9}[A-Z]{2}[0-9]{3}$/',
            'idade'=>'required',
            'temposervico'=>'required',
            'escola'=>'required',
            'actividadequeexerce'=>'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
                $dados = [
                    'datainicio'=>date('Y-m-d',strtotime($request->datainicio)),'instituiçãoondeestudou'=>$request->instituicao,'contacto'=>$request->contacto,
                    'actividadequeexerce' =>$request->actividadequeexerce,'numeroagente' =>$request->numeroagente,
                    'sexo' =>$request->sexo,'numerobi' =>$request->bi,'categoria' =>$request->categoria,'cargahorária' =>$request->cargahoraria,
                    'numeroINSS'=>$request->numeroINSS,'nome'=>$request->nome, 'nivelacademico' =>$request->nivelacademico,'idade' =>$request->idade,
                    'temposervico' =>$request->temposervico];
                    $pessoal = new  Pessoal_administrativos_professore($dados);
                    $escolas = Escola::find($request->escola);
                    $p =   $escolas->Pessoal_administrativos_professore()->save($pessoal);
                    if ($request->classe && $request->disciplina) {
                        # code...
          $p->professores()->create([ 'classe_id'=>$request->classe,'disciplina_id'=>$request->disciplina]);

                    }

           DB::commit();
        } catch (\Exception $e) {
             DB::rollBack();
            return redirect()->back()->with('sweet-error', $e->getMessage());

        }


        return redirect()->back()->with('sweet-success', 'o  funcionario  foi cadastrada com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professor = Pessoal_administrativos_professore::find($id);
        $escolas = Escola::all();
        $disciplinas = Disciplina::all();
        $classes  = Classe::all();
        return view('docentes.update',['professor'=>$professor,'escolas'=>$escolas,'disciplinas'=>$disciplinas,
        'classes'=>$classes]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validationRules =  [
            'nome' => 'required|min:6|max:100',
            'instituicao' => 'required|min:6|max:100',
            'datainicio'=>'required|date',
            'nivelacademico'=>'required',
            'contacto'=>'required|min:9|max:12',
            'cargahoraria'=>'required',
            'categoria'=>'required|min:4',
            'numeroINSS'=>'required|min:4',
            'numeroagente'=>'required|min:4',
            'sexo'=>'required',
            'bi' => 'required|min:14|regex:/^[0-9]{9}[A-Z]{2}[0-9]{3}$/',
            'idade'=>'required',
            'temposervico'=>'required',
            'escola'=>'required',
            'actividadequeexerce'=>'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
                     $pessoal = Pessoal_administrativos_professore::find($id);
                     $dados = [
                    'datainicio'=>date('Y-m-d',strtotime($request->datainicio)),'instituiçãoondeestudou'=>$request->instituicao,'contacto'=>$request->contacto,
                    'actividadequeexerce' =>$request->actividadequeexerce,'numeroagente' =>$request->numeroagente,
                    'sexo' =>$request->sexo,'numerobi' =>$request->bi,'categoria' =>$request->categoria,'cargahorária' =>$request->cargahoraria,
                    'numeroINSS'=>$request->numeroINSS,'nome'=>$request->nome, 'nivelacademico' =>$request->nivelacademico,'idade' =>$request->idade,
                    'temposervico' =>$request->temposervico,'escola_id'=>$request->escola];
                       $pessoal->update($dados);
                   if ( $request->classe && $request->disciplina) {
                    $pessoal->professores->update([ 'classe_id'=>$request->classe,'disciplina_id'=>$request->disciplina]);

                   }

           DB::commit();
        } catch (\Exception $e) {
             DB::rollBack();
            return redirect()->back()->with('sweet-error', $e->getMessage());
    }

    return redirect()->back()->with('sweet-success', 'os dados do funcionario  foi actualizado com sucesso.');

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
       $pessoal = Pessoal_administrativos_professore::find($id);
        if (!$found = $pessoal->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este funcionario'],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'os dados do funcionario foi elimindo com sucesso',

       ],200);

    }
}
