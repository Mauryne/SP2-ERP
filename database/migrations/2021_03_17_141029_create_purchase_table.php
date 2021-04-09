<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price',8, 2);
            $table->date('date');
            $table->integer('quantity');
            $table->unsignedInteger('supply_id');
            $table->unsignedInteger('provider_id');
            $table->foreign('supply_id')->references('id')->on('supplies');
            $table->foreign('provider_id')->references('id')->on('providers');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase');
    }
}
