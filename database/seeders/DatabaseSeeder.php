<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
      /*  DB::table('users')->insert([
        	'name'=>'Miguel sapalalo',
        	'email'=>'miguelsapalomiguel17@gmail.com',
        	'password'=>Hash::make('tchiyovo'),
            'tipo'=>'Administrador',


        	]);*/
            $data = [
            ['name'=>'relatorios'],
            ['name'=>'listar documentos'],
            ['name'=>'subir documentos'],
            ['name'=>'Lista de Alunos matriculado'],
            ['name'=>'cadastrar Alunos matriculado'],
            ['name'=>'Listar aproveitamento'],
            ['name'=>'cadastrar aproveitamento'],
            ['name'=>'Cadastrar ciclo'],
            ['name'=>'listar ciclos'],
            ['name'=>'Cadastrar escolas'],
            ['name'=>'listar escola'],
            ['name'=>'cadastrar docentes'],
            ['name'=>'Listar docentes'],
            ['name'=>'Cadastrar disciplina'],
            ['name'=>'Listar desciplina'],
            ['name'=>'Cadastrar classes'],
            ['name'=> 'Listar classes'],
            ['name'=>'editar usuarios'],
            ['name'=>'eliminar usuarios'],
            ['name'=>'editar documentos'],
            ['name'=>'eliminar documentos'],
            ['name'=>'editar Alunos matriculado'],
            ['name'=>'eliminar alunos matriculado'],
            ['name'=>'editar aproveitamento'],
            ['name'=>'elimnar aproveitamento'],
            ['name'=>'editar ciclo'],
            ['name'=>'eliminar ciclos'],
            ['name'=>'editar escolas'],
            ['name'=>'eliminar escola'],
            ['name'=>'editar docentes'],
            ['name'=>'eliminar docentes'],
            ['name'=>'editar disciplina'],
            ['name'=>'eliminar desciplina'],
            ['name'=>'editar classes'],
            ['name'=> 'eliminar classes']];
 /*for ($i=0; $i <count($data) ; $i++) {
     # code...
     Permission::create($data[$i]);
 }*/



 Permission::create(['name'=> 'Listar classes']);

    }
}
