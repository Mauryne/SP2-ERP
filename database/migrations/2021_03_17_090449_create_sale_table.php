<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('price',5, 2);
            $table->string('state')->nullable();
            $table->unsignedInteger('device_id');
            $table->unsignedInteger('customer_id');
            $table->foreign('device_id')->references('id')->on('devices');
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('sale');
    }
}
