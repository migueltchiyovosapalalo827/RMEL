<?php

namespace App\Http\Controllers;

use App\Http\Entities\Collection;
use App\Models\Funcionarios;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use stdClass;

//use Yajra\DataTables\Facades\DataTables;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

     public $useres ;

     public  function __construct() {
         $this->useres = new User();
     }

    public function index(Request $request)
    {
        //

        if ($request->ajax()) {
            $data = User::latest()->get();
            return  Datatables::of($data)->make(true);
        }
        return view('User.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


     $permissions = ['Chefe do Recursos Humanos','secretario(a)','Chefe da Secção da Educação e Ensino'];
        $roles = Role::all();

        return view('User.create',[
            'roles' => $roles,

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

        $validationRules = [
            'name'     => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'roles' => 'required|array',

        ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {

             $user =   User::create([
                'email'    => $request->email,
                'name' => $request->name,
                'password' =>Hash::make($request->password)
                ]);

            $user->assignRole($request->roles);
        } catch (\Exception $e) {
           DB::rollBack();

            return redirect()->back()->with('sweet-error', $e->getMessage());
        }
        DB::Commit();
        return redirect()->back()->with('sweet-success', 'usuarios criado com sucesso');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //

       $fun =  new Funcionarios();
       $funcionario  = $user->funcionario;
       $f = $funcionario ? $funcionario : $fun;

        return view('User.profile',['funcionario' => $f]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $fun =  new Funcionarios();
        $funcionario  = $user->funcionario;
        $f = $funcionario ??  $fun;

        $permissions = ['Chefe do Recursos Humanos','secretario(a)','Chefe da Secção da Educação e Ensino'];
        $roles = Role::all();
        return view('User.update',['user'=>$user->fresh('roles'),'roles' => $roles,'funcionario'=>$f]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //

          //
          $validationRules =  [
            'name' => 'required|max:255',
            'nome' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:6|confirmed',
            'endereco'=>'required',
            'telefone'=>'required|min:9|max:12',
            'bi' => 'required|min:14|regex:/^[0-9]{9}[A-Z]{2}[0-9]{3}$/',
            'roles' => 'required|array',
            ];

            $validator = Validator::make($request->all(),$validationRules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('sweet-error',"Ops...há algo de errado! Verifique se os campos obrigatórios foram inseridos corretamente." );
            }

            DB::beginTransaction();
            try {

                 $user->update([
                    'email'    => $request->email,
                    'name' => $request->name,
                    'password' =>Hash::make($request->password)
                    ]);
                    $user->syncRoles($request->roles);
                    $retVal = (is_null($user->funcionario)) ?    $user->funcionario()->create(['nome'=>$request->nome,'contacto'=>$request->telefone,'endereco'=>$request->endereco,
                    'bi'=>$request->bi]): $user->funcionario()->update(['nome'=>$request->nome,'contacto'=>$request->telefone,'endereco'=>$request->endereco,
                  'bi'=>$request->bi]);

            } catch (\Exception $e) {
               DB::rollBack();

              return redirect()->back()->with('sweet-error', $e->getMessage());
            }
            DB::Commit();
            return redirect()->back()->with('sweet-success', 'os dados do usuarios foram actualizados com sucesso');

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if (!$found = $user->delete()) {
            return response(['success'=>false,
            'message'=>'não foi possivel eliminar este usuario'],422);

        }

        return response(['success'=>true,
        'data'=>$found,
        'message'=>'usuario elimindo com sucesso',

       ],200);
    }

    public function perfil(Request $request, User $user)
    {

        $validationRules = [
            'nome'     => 'required|string|max:255',
            'bi' => 'required|min:14|regex:/^[0-9]{9}[A-Z]{2}[0-9]{3}$/|unique:funcionarios',
            'endereco'   => 'required|string|min:8',
            'contacto'   => 'required|string|min:9',


        ];


        $validator = Validator::make($request->all(),$validationRules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('erro',true);
        }

        DB::beginTransaction();

        try {
           $funcionario = new Funcionarios(['nome'=> $request->nome,'bi'=> $request->bi,'endereco' => $request->endereco,

           'contacto'=> $request->contacto]);

              $user->funcionario()->save($funcionario);

           DB::Commit();

        } catch (\Exception $e) {
           DB::rollBack();
          return redirect()->back()->with('sweet-error', $e->getMessage());
        }

        return redirect()->back()->with('sweet-success', 'Os dados pessoas do funcionarios foi salvo com sucesso');

    }
}
