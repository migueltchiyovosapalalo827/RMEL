<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumento2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documentos', function (Blueprint $table) {
            $table->unsignedBigInteger('escola_id');
            $table->foreign('escola_id')->references('id')->on('escolas')
            ->onUpdate('cascade')
            ->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('ciclo_id');
            $table->foreign('ciclo_id')->references('id')->on('ciclos')
            ->onUpdate('cascade')
            ->onDelete('cascade')->nullable();
            $table->string('ano')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::dropIfExists('documento2');
    }
}
