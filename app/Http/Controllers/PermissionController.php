<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax())
        {
          return DataTables::of(Permission::all())->make(true);
        }
        return view('permission.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('permission.create');
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
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
           ]);

           if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput();
           }
        DB::beginTransaction();
        try {
            //code...
            Permission::create($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('sweet-error', 'Erro ao criar permissão');
        }
        DB::commit();
        return redirect()->back()->with('sweet-success', 'Permissão criada com sucesso');

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
        $permission = Permission::find($id);
        return view('permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $permission = Permission::find($id);
        return view('permission.update', compact('permission'));
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
        $validator = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
           ]);

           if ($validator->fails()) {
               return redirect()->back()->withErrors($validator)->withInput();
           }
        DB::beginTransaction();
        try {
            //code...
            $permission = Permission::find($id);
            $permission->update($request->all());
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('sweet-error', 'Erro ao atualizar permissão');
        }
        DB::commit();
        return redirect()->back()->with('sweet-success', 'Permissão atualizada com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::beginTransaction();
        try {
            //code...
            $permission = Permission::find($id);
            $permission->delete();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
          //  return redirect()->back()->with('sweet-error', 'Erro ao excluir permissão');
          return response([
              'status' => 'error',
                'message' => 'Erro ao excluir permissão',
                'success' => false
          ],422);
        }
        DB::commit();
      //  return redirect()->back()->with('sweet-success', 'Permissão excluída com sucesso');
        return response([
            'status' => 'success',
                'message' => 'Permissão excluída com sucesso',
                'success' => true
        ],200);

    }
}
