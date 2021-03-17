<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serialNumber');
            $table->string('productReference');
            $table->date('saleDate')->nullable();
            $table->unsignedInteger('installation_id')->nullable();
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('europeanNorm_id')->nullable();
            $table->unsignedInteger('contract_id')->nullable();
            $table->foreign('installation_id')->references('id')->on('installations');
            $table->foreign('type_id')->references('id')->on('types');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('contract_id')->references('id')->on('contracts');
            $table->foreign('europeanNorm_id')->references('id')->on('european_norms');
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
        Schema::dropIfExists('devices');
    }
}
