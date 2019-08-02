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
            $table->increments('id');
            $table->string('label');
            $table->integer('actionplans_id')->unsigned();
            $table->date('DTprevEnd');
            $table->date('newDTforEnd')->nullable();
            $table->date('DTend')->nullable();
            $table->date('DTverify');
            $table->boolean('effective')->nullable();
            $table->boolean('duplicate');
            $table->string('beforeaction')->nullable();
            $table->foreign('actionplans_id')->references('id')->on('actionplans');
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
