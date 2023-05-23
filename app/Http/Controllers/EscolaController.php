<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Escola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EscolaController extends Controller
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
            $data = Escola::with('ciclos')->latest()->get();
            return  Datatables::of($data)->make(true);
        }
        return view('escola.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         $ciclos = Ciclo::latest()->get();
        return view('escola.create',compact('ciclos'));
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
            'nome' => 'required|min:10|max:255',
            'numero' => 'required|min:6|max:10',
            'ciclo' => 'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
                 //'ciclo'=>$request->ciclo,'user_id'=>Auth::user()->id
            $dados  = new Escola(['nomeescola'=>$request->nome, 'numeroescola'=> $request->numero]);
            $escola =Auth::user()->escolas()->save($dados);

           /* for ($i=0; $i < count($request->ciclo); $i++) {
                # code...
                $escola->ciclos()->attach($request->ciclo[$i]);
            }*/
            $escola->ciclos()->attach($request->ciclo);

           DB::commit();
        } catch (\Exception $e) {
             DB::rollBack();

             dd($e->getMessage());
            //return redirect()->back()->with('sweet-error', $e->getMessage());

        }
       return redirect()->back()->with('sweet-success', 'a escola foi cadastrada com sucesso.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Escola $escola)
    {
        //
        if ($request->ajax()) {
            return response()->json($escola->ciclos);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Escola $escola)
    {
        //
        $ciclos = Ciclo::latest()->get();
        return view('escola.update',compact('escola','ciclos'));
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
            'nome' => 'required|min:10|max:255',
            'numero' => 'required|min:6|max:10',
            'ciclo' => 'required',
            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
          //'ciclo'=>$request->ciclo
            $dados = ['nomeescola'=>$request->nome, 'numeroescola'=> $request->numero];
            $escola = Escola::find($id);
            $escola->update($dados);
           /* for ($i=0; $i < count($request->ciclo); $i++) {
                # code...
                $escola->ciclos()->sync($request->ciclo[$i]);
            }*/
            $escola->ciclos()->sync($request->ciclo);
           DB::commit();
        } catch (\Exception $e) {
             DB::rollBack();
            return redirect()->back()->with('sweet-error', $e->getMessage());

        }


        return redirect()->back()->with('sweet-success', 'a escola foi actaulizado com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Escola $escola)
    {
        //

          //

          if (!$found = $escola->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este escola'],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'a escola elimindo com sucesso',

       ],200);
    }
}
