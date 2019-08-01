<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->enum('type', ['Férias', 'Evento', 'Evento Fiscal', 'Reuniões', 'lembrete']);
            $table->date('dateStart');
            $table->date('dateEnd')->nullable();
            $table->boolean('allDay')->nullable();
            $table->boolean('active', 1);
            $table->string('color');
            $table->enum('recurrence', ['weekly', 'biweekly', 'monthly', 'Yearly'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
