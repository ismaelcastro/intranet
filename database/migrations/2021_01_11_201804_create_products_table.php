<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('codp');
            $table->string('apelido');
            $table->string('nome');
            $table->string('dsUnidade');
            $table->double('qtd', 10, 2);
            $table->double('qtSaldo', 10, 2)->nullable();
            $table->double('valor', 10, 2);
            //$table->double('qtReserva', 10, 2);
            $table->char('fvenda');
            $table->string('dsLocal');
            $table->string('Tipo');
            $table->unsignedInteger('cdLote')->nullable();
            $table->string('numSerie')->nullable();
            $table->unsignedInteger('id_contract');

            $table->unsignedInteger('id_branch');
            $table->foreign('id_branch')->references('id')->on('branches');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
