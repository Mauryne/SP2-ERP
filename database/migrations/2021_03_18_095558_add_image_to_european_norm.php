<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToEuropeanNorm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('european_norms', function (Blueprint $table) {
        $table->string('picture_path');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('european_norms', function (Blueprint $table) {
        $table->dropColumn('picture_path');
    });
}

}
