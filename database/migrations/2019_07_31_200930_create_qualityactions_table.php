<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQualityactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualityactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('action_plans_id')->unsigned();
            $table->date('DTprevEnd');
            $table->date('newDTforEnd')->nullable();
            $table->foreign('action_plans_id')->references('id')->on('action_plans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qualityactions');
    }
}
