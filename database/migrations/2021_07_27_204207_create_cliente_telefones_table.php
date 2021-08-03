<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_telefones', function (Blueprint $table) {
            $table->id();
            $table->integer('cliente_id')->unsigned;
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->integer('telefone_tipo_id')->unsigned;
            $table->foreign('telefone_tipo_id')->references('id')->on('tipo_telefones');
            $table->string('numero',11);
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
        Schema::dropIfExists('cliente_telefones');
    }
}
