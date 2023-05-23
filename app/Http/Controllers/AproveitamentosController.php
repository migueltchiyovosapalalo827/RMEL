<?php

namespace App\Http\Controllers;

use App\Models\aproveitamento;
use App\Models\Classe;
use App\Models\Escola;
use Illuminate\Http\Request;
use App\Traits\estaticaTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AproveitamentosController extends Controller
{    Use estaticaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
       if($request->ajax()){
          $dados = aproveitamento::with('classe')->latest()->get();
          return  DataTables::of($dados)->make(true);
        }

           return view('aprovietamento.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $classe = Classe::all();
        $escolas = Escola::all();
        return  view('aprovietamento.create',['classes'=>$classe,'escolas'=>$escolas]);
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
            'anolectivo' => 'required|min:4|max:9',
            'Trimestre' => 'required',
            'avaliados'=>'required',
            'reprovados'=>'required',
            'desistidos'=>'required',
            'matriculados'=>'required',
            'aprovados'=>'required',
            'classe' =>'required',
            'escola_id' =>'required',


            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            //abandono			reprovados	matriculados	avaliados	aproveitamento
            $dados = [
                'aproveitamento'=> $this->Taxa_aproveitamento($request),'abandono'=>$this->Taxa_abandono($request),
                'rendimento'=>$this->Taxa_rendimento($request),
                'anolectivo' =>$request->anolectivo,'reprovados' =>$request->reprovados,'desistidos' =>$request->desistidos,'aprovados' =>$request->aprovados,
                'trimestre' =>$request->Trimestre,'avaliados'=>$request->avaliados,'matriculados'=>$request->matriculados,
                  'user_id' => Auth::user()->id,
                  'classe_id' => $request->classe,

            ];
                $aproveitamento = new  aproveitamento($dados);
                $escola = Escola::find($request->escola_id);
                $escola->aproveitamento()->save($aproveitamento);


       DB::commit();
    } catch (\Exception $e) {
         DB::rollBack();

        return redirect()->back()->with('sweet-error', $e->getMessage());

    }


    return redirect()->back()->with('sweet-success', 'o aproveitamento foi cadastrada com sucesso.');


    }

    /**
     * Display the specified resource.
     *
     * @param  aproveitamento $aproveitamento
     * @return \Illuminate\Http\Response
     */
    public function show(aproveitamento $aproveitamento)
    {
        //
        return view('aprovietamento.show',['aproveitamento'=>$aproveitamento]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(aproveitamento $aproveitamento)
    {
        //
        $classe = Classe::all();
         $escolas = Escola::all();
        return  view('aprovietamento.update',['classes'=>$classe,'aproveitamento'=>$aproveitamento,'escolas'=>$escolas]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  aproveitamento  $aproveitamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,aproveitamento   $aproveitamento)
    {
        //

        $validationRules =  [
            'anolectivo' => 'required|min:4|max:9',
            'Trimestre' => 'required',
            'avaliados'=>'required',
            'reprovados'=>'required',
            'desistidos'=>'required',
            'matriculados'=>'required',
            'aprovados'=>'required',
            'classe' =>'required',
            'escola_id' =>'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        }

        DB::beginTransaction();
        try {

            //abandono			reprovados	matriculados	avaliados	aproveitamento
            $dados = [
                'aproveitamento'=> $this->Taxa_aproveitamento($request),'abandono'=>$this->Taxa_abandono($request),'rendimento'=>$this->Taxa_rendimento($request),
                'anolectivo' =>$request->anolectivo,'reprovados' =>$request->reprovados,'desistidos' =>$request->desistidos,'aprovados' =>$request->aprovados,
                'trimestre' =>$request->Trimestre,'avaliados'=>$request->avaliados,'matriculados'=>$request->matriculados,
                  'user_id' => Auth::user()->id,'classe_id'=>$request->classe,'escola_id'=>$request->escola_id,
            ];
                $aproveitamento->update($dados);

       DB::commit();
    } catch (\Exception $e) {
         DB::rollBack();

        return redirect()->back()->with('sweet-error', $e->getMessage());
    }

    return redirect()->back()->with('sweet-success', 'o aproveitamento foi actualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  aproveitamento $aproveitamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(aproveitamento $aproveitamento)
    {
        //

        if (!$found = $aproveitamento->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este aproveitamento'],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'aproveitamento  elimindo com sucesso',

       ],200);
    }
}
