<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ClassesController extends Controller
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
            $data = Classe::latest()->get();
            return  DataTables::of($data)->make(true);
        }
        return view('classe.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('classe.create');
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

      $validationRules =  [
            'nome' => 'required|min:5|max:255',
            'descricao' => 'required|min:10|max:255',

            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $dados  = ['nome'=>$request->nome, 'descricao'=> $request->descricao];
             Classe::create($dados);

           DB::commit();
        } catch (\Exception $e) {
             DB::rollBack();

             return redirect()->back()->with('sweet-error', $e->getMessage());

        }


        return redirect()->back()->with('sweet-success', 'a classe foi cadastrada com sucesso.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(classe $classe)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(classe $classe)
    {
        //

        return view('classe.update',['classe'=>$classe]);
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
            'nome' => 'required|min:5|max:255',
            'descricao' => 'required|min:10|max:255',

            ];



        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {

            $dados  = ['nome'=>$request->nome, 'descricao'=> $request->descricao];
            $classe = Classe::find($id);
            $classe->update($dados);
           // Auth::user()->classes()->update($dados);

           DB::commit();
        } catch (\Exception $e) {
             DB::rollBack();
            return redirect()->back()->with('sweet-error', $e->getMessage());

        }


        return redirect()->back()->with('sweet-success', 'a classe foi actaulizado com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classe $classe)
    {
        //

          //

          if (!$found = $classe->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este classe'],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'a classe elimindo com sucesso',

       ],200);
    }
}
