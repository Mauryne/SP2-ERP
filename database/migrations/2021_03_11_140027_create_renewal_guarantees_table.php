<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRenewalGuaranteesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renewal_guarantees', function (Blueprint $table) {
            $table->id();
            $table->integer('duration');
            $table->date('signatureDate');
            $table->unsignedBigInteger('guarantee_id');
            $table->foreign('guarantee_id')->references('id')->on('guarantees');
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
        Schema::dropIfExists('renewal_guarantees');
    }
}
