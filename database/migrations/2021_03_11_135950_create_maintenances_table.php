<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('streetNumber');
            $table->string('street');
            $table->integer('postalCode');
            $table->string('city');
            $table->date('date');
            $table->string('comment')->nullable();
            $table->boolean('externalProvider');
            $table->unsignedInteger('device_id');
            $table->foreign('device_id')->references('id')->on('devices');
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
        Schema::dropIfExists('maintenances');
    }
}
