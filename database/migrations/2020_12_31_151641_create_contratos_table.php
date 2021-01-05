<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContratosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Deu certo :D
        
        Schema::create('contratos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numeroContrato');
            $table->mediumText('descricao');
            $table->date('dtFaturamento')->nullable();
            $table->date('dataEmissao');
            $table->date('dataInicio');
            $table->date('dataFinal');
            $table->double('valor', 10,2);
            $table->boolean('ativo', 1);
            
            $table->unsignedInteger('id_planoVenda');
            $table->foreign('id_planoVenda')->references('id')->on('planovendas');
            
            $table->unsignedInteger('id_cliente');
            $table->foreign('id_cliente')->references('id')->on('clientes');
                        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contratos');
    }
}
