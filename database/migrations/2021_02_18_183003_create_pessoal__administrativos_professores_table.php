<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoalAdministrativosProfessoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoal_administrativos_professores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('escola_id');
            $table->foreign('escola_id')->references('id')->on('escolas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->date('datainicio');
            $table->string('instituiçãoondeestudou');
            $table->string('contacto');
            $table->string('disciplina')->nullable();
            $table->string('actividadequeexerce');
            $table->string('numeroagente');
            $table->string('sexo');
            $table->string('numerobi');
            $table->string('categoria');
            $table->string('cargahorária');
            $table->string('numeroINSS');
            $table->string('nome');
            $table->string('nivelacademico');
            $table->string('classequeleciona')->nullable();
            $table->integer('idade');
            $table->string('tipo');
            $table->integer('temposervico');
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pessoal_administrativos_professores');
    }
}
