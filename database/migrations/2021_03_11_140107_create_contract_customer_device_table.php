<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractCustomerDeviceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_customer_device', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('device_id');
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('contract_id');
            $table->foreign('device_id')->references('id')->on('devices');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('contract_id')->references('id')->on('contracts');
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
        Schema::dropIfExists('contract_customer_device');
    }
}
