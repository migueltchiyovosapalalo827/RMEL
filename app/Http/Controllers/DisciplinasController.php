<?php

namespace App\Http\Controllers;

use App\Models\Disciplina;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DisciplinasController extends Controller
{  /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index(Request $request)
   {
       //


       if ($request->ajax()) {
           $data = Disciplina::latest()->get();
           return  Datatables::of($data)->make(true);
       }
       return view('desciplina.index');

   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create()
   {
       //

       return view('desciplina.create');
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
            Disciplina::create($dados);

          DB::commit();
       } catch (\Exception $e) {
            DB::rollBack();

           return redirect()->back()->with('sweet-error', $e->getMessage());

       }


       return redirect()->back()->with('sweet-success', 'a Disciplina foi cadastrada com sucesso.');

   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show(Disciplina $Disciplina)
   {
       //

   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit(Disciplina $disciplina)
   {
       //

       return view('desciplina.update',['disciplina'=>$disciplina]);
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
           $disciplina = Disciplina::find($id);
           $disciplina->save($dados);
          // Auth::user()->Disciplinas()->update($dados);

          DB::commit();
       } catch (\Exception $e) {
            DB::rollBack();
           return redirect()->back()->with('sweet-error', $e->getMessage());

       }


       return redirect()->back()->with('sweet-success', 'a Disciplina foi actaulizado com sucesso.');

   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy(Disciplina $disciplina)
   {
       //

         //

         if (!$found = $disciplina->delete()) {
           return response(['success'=>false,
           'message'=>'não foi possivel eliminar este Disciplina'],422);

       }

       return response(['success'=>true,
       'data'=>$found,
       'message'=>'a Disciplina elimindo com sucesso',

      ],200);
   }
}
