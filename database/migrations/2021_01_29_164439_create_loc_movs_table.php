<?php

use App\Products;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLocMovsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loc_movs', function (Blueprint $table) {
            $table->increments('id');
            $table->date('created_at')->default(DB::raw('NOW()'));
            $table->enum('tp', ['E', 'S', 'R']);
            $table->string('origem');
            $table->string('destino');

            $table->unsignedInteger('contract_id')->nullable();
            $table->foreign('contract_id')->references('id')->on('contracts');

            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loc_movs');
    }
}
