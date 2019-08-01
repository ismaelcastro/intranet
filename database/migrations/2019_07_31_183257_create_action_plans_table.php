<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actionplans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label');
            $table->dateTime('openingDate');
            $table->enum('typeAction', ['Melhoria', 'Corretiva']);
            $table->enum('source', ['Auditoria Interna', 'Auditoria Externa', 'Monitoramento de Processo']);
            $table->enum('status', ['Aberto', 'Fechado']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actionplans');
    }
}
