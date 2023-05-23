<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Role;
use App\Uteis\Menu as UteisMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->ajax())
        {
            return view('menu.index',['roles'  => Role::all(),
            'menus' => Menu::orderBy('sequence', 'asc')->get()]);
        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('menu.create');
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
            'nome' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'active' => 'required|boolean',
            'parent_id' => 'required|integer',
            'roles' => 'required|array',]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

        DB::beginTransaction();
        try {
            //code...
          $request->merge(['sequence', Menu::max('sequence') + 1]);
           $menu = Menu::create($request->all());
          $menu->roles()->sync($request->roles);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            return redirect()->back()->with('sweet-error', 'Erro ao criar menu');

        }
        DB::commit();
        return redirect()->back()->with('sweet-success', 'Menu criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
        return view('menu.show', compact('menu'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu,Request $request)
    {
        //

        $roles = Role::select('id', 'name as text')->get()->toArray();
        $menus = Menu::select('id','nome as text')->get()->toArray();
        if($request->ajax())
        {
          return response(['menu'=>$menu,
                            'role'=> $menu->roles()->pluck('id')->toArray(),
                            'roles'=>$roles,
                            'menus'=>$menus]);



        }
       // return view('menu.update', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        //
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'active' => 'required|boolean',
            'parent_id' => 'required|integer',
            'roles' => 'required|array',]);
            if ($validator->fails()) {
               // return redirect()->back()->withErrors($validator)->withInput();
                return response([
                    'status' => 'error',
                    'errors' => $validator->errors()
                ], 400);
            }

           DB::beginTransaction();
        try {
            //code...
            $menu->update($request->except('roles'));
            $menu->roles()->sync($request->roles);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
           // return redirect()->back()->with('sweet-error', 'Erro ao atualizar menu');
           return response([
                'status' => 'error',
                'errors' => $th->getMessage(),
            ], 422);

        }
        DB::commit();
       // return redirect()->back()->with('sweet-success', 'Menu atualizado com sucesso');
        return response([
            'status' => 'success',
            'message' => 'Menu atualizado com sucesso',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        //
        DB::beginTransaction();
        try {
            //code...
            $menu->delete();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            //return redirect()->back()->with('sweet-error', 'Erro ao excluir menu');
            return response([
                'status' => 'error',
                'message' => 'Erro ao excluir menu',
                'success' => false,
            ], 422);

        }
        DB::commit();
      //  return redirect()->back()->with('sweet-success', 'Menu excluido com sucesso');
      return response([
        'status' => 'success',
        'message' => 'Menu excluido com sucesso',
        'success' => true,], 200);
    }
    // make function call view menu add role
    public function addRole()
    {
        //
        return response()->json(['data'=>UteisMenu::nestable()]);
    }

    //make function sync menu and role
    public function sync(Request $request)
    {
        //
        $data = $request->json()->all();

        $menu = new Menu();
        DB::beginTransaction();
        try {
            $i = 1;
            foreach ($data as $item) {
                $menu =  Menu::find($item['id']);
                if (isset($item['parent_id'])) {
                    $menu->parent_id = $item['parent_id'];
                    $menu->sequence = $i++;
                } else {
                    $menu->parent_id = 0;
                    $menu->sequence = $i++;
                }
                $menu->save();
            }


        } catch (\Exception $e) {
            DB::rollBack();
           return response([
                'status' => 'error',
                'message' =>  'Erro ao ordenar o  menu',
                'success' => false,
                'data'=>$data,
            ], 400);

        }
         DB::commit();
         return response(
            [   'status' => 'success',
                'message' => 'Menu ordenado com sucesso',
                'success' => true,
                'data'=>$data,
            ], 200);
    }


}
