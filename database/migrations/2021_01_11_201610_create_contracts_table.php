<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numberContract');
            $table->mediumText('description');
            $table->date('dtbilling')->nullable();
            $table->date('dtemission');
            $table->date('dtStart');
            $table->date('dtEnd');
            $table->double('price', 10,2);
            $table->boolean('active', 1);
            $table->string('manager');

            $table->unsignedInteger('id_branch');
            $table->foreign('id_branch')->references('id')->on('branches');
            
            $table->unsignedInteger('id_type');
            $table->foreign('id_type')->references('id')->on('contracts_types');

            $table->unsignedInteger('id_saleplans');
            $table->foreign('id_saleplans')->references('id')->on('saleplans');
            
            $table->unsignedInteger('id_customers');
            $table->foreign('id_customers')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
