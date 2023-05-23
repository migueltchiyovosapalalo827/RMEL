<?php

namespace App\Http\Controllers;

use App\Models\Ciclo;
use App\Models\Documento;
use App\Models\Escola;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class DocumentosController extends Controller
{/**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        //

      if ($request->ajax()) {
            $data = Documento::with(['escolas','ciclos'])->latest()->get();
            return  Datatables::of($data)->make(true);
        }
        return view('documentos.index');
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
         $ciclos  = Ciclo::all();
        return view('documentos.create', compact('escolas','ciclos'));
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
            'tipo' => 'required|min:5|max:255',
            'nome' => 'required|min:10|max:255',
            'escola'  => 'required',
            'ciclo'  => 'required',
            'ano' =>  'required',
            'documento' => 'required|max:10000|mimes:doc,docx,png,jpeg,pdf,xlsx,xls,ppt,pptx,txt'

            ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
           $path = Storage::putFileAs(
            'public/documentos', $request->file('documento'), $request->file('documento')->getClientOriginalName());
          $documento  = new Documento(['tipo'=>$request->tipo, 'nome'=> $request->nome, 'escola_id' => $request->escola,
          'ciclo_id' => $request->ciclo,'ano' => $request->ano,'ficheiro'=> $path]);
           Auth::user()->documentos()->save($documento);
           DB::commit();
        } catch (\Exception $e) {
             DB::rollBack();

            return redirect()->back()->with('sweet-error', $e->getMessage());

        }


        return redirect()->back()->with('sweet-success', 'a Documento foi cadastrada com sucesso.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {
        //
        return Storage::download($documento->ficheiro);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //
        $escolas = Escola::all();
        $ciclos  = Ciclo::all();
        return view('documentos.update',compact('documento','escolas','ciclos'));
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
         
         //dd($request);
        //
        $validationRules =  [
            'tipo' => 'required|min:5|max:255',
            'nome' => 'required|min:10|max:255',
            'escola'  => 'required',
            'ciclo'  => 'required',
            'ano' =>  'required',
            'documentos' => 'file|max:10000|mimes:doc,docx,png,jpeg,pdf,xlsx,xls,ppt,pptx,txt'
            ];



        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            if ($request->hasFile('documentos')) 
            {
                 $path = Storage::putFileAs(
                'public/documentos', $request->file('documentos'), $request->file('documentos')->getClientOriginalName()

            );

            }
          
           $documento = Documento::find($id);
            $dados  =['tipo'=>$request->tipo, 'nome'=> $request->nome,'escola_id' => $request->escola,
             'ciclo_id' => $request->ciclo,'ano' => $request->ano,  'ficheiro'=>  (isset($path)) ? $path : $documento->ficheiro];
            $documento->update($dados);
           // Auth::user()->Documentos()->update($dados);

           DB::commit();
        } catch (\Exception $e) {
             DB::rollBack();
            return redirect()->back()->with('sweet-error', $e->getMessage());

        }


        return redirect()->back()->with('sweet-success', ' O documento foi actaulizado com sucesso.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Documento $documento)
    {
        //

          //
              $nome =  $documento->ficheiro;
          if (!$found = $documento->delete()) {

            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este Documento'],422);

        }
        Storage::disk('local')->delete($nome);
        return response(['success'=>true,
        'data'=>$found,
        'message'=>'a Documento elimindo com sucesso',

       ],200);
    }
}
