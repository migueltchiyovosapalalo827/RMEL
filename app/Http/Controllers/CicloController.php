<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CicloController extends Controller
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
            $ciclo = Ciclo::latest()->get();
            return DataTables::of($ciclo)->make(true);
        }

        return view('ciclo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('ciclo.create');
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
              # code...
              return redirect()->back()->withErrors($validator)->withInput();
          }

          DB::beginTransaction();

          try {

            $dados  = ['nome'=>$request->nome, 'descricao'=> $request->descricao];
             Ciclo::create($dados);

        } catch (\Exception $e) {
             DB::rollBack();

             return redirect()->back()->with('sweet-error', $e->getMessage());

        }

        DB::commit();
        return redirect()->back()->with('sweet-success', 'o ciclo foi cadastrado com sucesso.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function show(Ciclo $ciclo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciclo $ciclo)
    {
        //
        return view('ciclo.update',compact('ciclo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ciclo $ciclo)
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

            $ciclo->update($dados);


           DB::commit();
        } catch (\Exception $e) {
             DB::rollBack();
            return redirect()->back()->with('sweet-error', $e->getMessage());

        }


        return redirect()->back()->with('sweet-success', 'o ciclo foi actaulizado com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ciclo  $ciclo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ciclo $ciclo)
    {
        //

        if (!$found = $ciclo->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este ciclo'],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'o ciclo elimindo com sucesso',

       ],200);
    }
}
