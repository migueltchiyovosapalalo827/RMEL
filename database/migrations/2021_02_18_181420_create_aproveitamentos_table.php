<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAproveitamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aproveitamentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->float('abandono');
            $table->float('rendimento');
            $table->float('desistidos');
            $table->float('reprovados');
            $table->float('matriculados');
            $table->float('avaliados');
            $table->float('aproveitamento');
            $table->float('aprovados');
            $table->integer('trimestre')->nullable();
            $table->string('anolectivo')->nullable();
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
        Schema::dropIfExists('aproveitamentos');
    }
}
