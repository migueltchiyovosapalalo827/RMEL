<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
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
            $data = Role::latest()->get()->fresh('permissions');
            return  DataTables::of($data)->make(true);
        }
        return view('Role.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('Role.create',[
            'permissions' => $permissions,
        ]);
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
            'permissions' => 'required|array',]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

        DB::beginTransaction();
        try {
            //code...
            $role = Role::create(['name' => $request->name,'guard_name'=>'web']);
            $role->syncPermissions($request->permissions);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            dd($th->getMessage());
           // return redirect()->back()->with('sweet-error', 'Erro ao cadastrar a função');
        }
        DB::commit();
        return redirect()->back()->with('sweet-success', 'Função cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
        return view('Role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $funcao)
    {
        //

        $permissions = Permission::all();
        return view('Role.update',[
            'role' => $funcao,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $role)
    {
        //

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            DB::beginTransaction();
            try {
                //code...
                $role = Role::find($role);
                $role->update(['name' => $request->name,'guard_name'=>'web']);
                $role->syncPermissions($request->permissions);
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollback();
                return redirect()->back()->with('sweet-error', 'Erro ao atualizar a função');
            }
            DB::commit();
            return redirect()->back()->with('sweet-success', 'Função atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $funcao)
    {
        //

        DB::beginTransaction();
        try {
            //code...
            $funcao->delete();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
           return response([
                'status' => 'error',
                'success' => false,
                'message' => 'Erro ao excluir a função'.$funcao->name,
            ], 422);
        }
        DB::commit();

        return response([
            'status' => 'success',
            'success' => true,
            'message' => 'Função excluído com sucesso',
        ], 200);
    }
}
