<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Escola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MatriculasController extends Controller
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
            # code...
            $matricula = Escola::join('matriculas', 'escolas.id', '=', 'matriculas.escola_id')
                ->join('classes', 'classes.id', '=', 'matriculas.classe_id')
                ->select('escolas.nomeescola as escola', 'classes.nome as classe', 'matriculas.*')
                ->get();
            return DataTables::of($matricula)->make(true);
        }

        return view('matricula.index');
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
        $classes =  Classe::all();

        return view('matricula.create', compact('escolas', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validationRules = [
            'classe'     => 'required',
            'escola' => 'required',
            'anolectivo' => 'required|max:10',
            'alunos' => 'required|max:10000',


        ];


        $validator = Validator::make($request->all(), $validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {

            $escolas = Escola::find($request->escola);
            $escolas->classes()->attach($request->classe, ['total_alunos' => $request->alunos_masculinos +  $request->alunos_femininos, 'alunos_masculinos' => $request->alunos_masculinos, 'alunos_femininos' => $request->alunos_femininos, 'anolectivo' => $request->anolectivo, 'ciclo' => $request->ciclo]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('sweet-error', $e->getMessage());
        }
        DB::Commit();
        return redirect()->back()->with('sweet-success', 'A quantidade de alunnos matriculado foi salvo com sucesso');
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
        $escola = Escola::with("classes")->find($id);
        return view('matricula.show', compact('escola'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($escola_id, $classe_id)
    {
        //

        $matricula = Escola::join('matriculas', 'escolas.id', '=', 'matriculas.escola_id')
            ->join('classes', 'classes.id', '=', 'matriculas.classe_id')->where('matriculas.escola_id', $escola_id)
            ->where('matriculas.classe_id', $classe_id)
            ->select('escolas.nomeescola as escola', 'escolas.id as escola_id', 'classes.nome as classe', 'matriculas.*')
            ->get();
        $classes = Classe::all();
        dd($matricula);
        // return view('matricula.update',compact('matricula','classes'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editar($escola_id, $classe_id)
    {
        //

        $matriculas = Escola::join('matriculas', 'escolas.id', '=', 'matriculas.escola_id')
            ->join('classes', 'classes.id', '=', 'matriculas.classe_id')->where('matriculas.escola_id', $escola_id)
            ->where('matriculas.classe_id', $classe_id)
            ->select('escolas.nomeescola as escola', 'escolas.id as escola_id', 'classes.nome as classe', 'matriculas.*')
            ->get();
        $classes = Classe::all();
        $escola = Escola::find($escola_id);

        return view('matricula.update', compact('matriculas', 'classes', 'escola'));
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
        $validationRules = [
            'classe' => 'required',
            'alunos' => 'required|max:10000',
            'anolectivo' => 'required|max:10',
        ];


        $validator = Validator::make($request->all(), $validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {

            $escola = Escola::find($request->escola);
            $escola->classes()->detach($request->classe);
            $escola->classes()->attach($request->classe, ['alunos' => $request->alunos, 'anolectivo' => $request->anolectivo, 'ciclo' => $request->ciclo]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('sweet-error', $e->getMessage());
        }
        DB::Commit();
        return redirect()->back()->with('sweet-success', 'A quantidade de alunnos matriculado foi actualizado  com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Escola $escola, Classe $classe)
    {
        //

        if (!$found = $escola->classes()->detach($classe->id)) {
            return response([
                'success' => false,
                'message' => 'não foi possivel eliminar este quantidade'
            ], 422);
        }

        return response([
            'success' => true,
            'data' => $found,
            'message' => 'Quantidade elimindo com sucesso',

        ], 200);
    }
}
