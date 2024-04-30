<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoggingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beone_log', function (Blueprint $table) {
            $table->string('table', 100);
            $table->string('user', 100);
            $table->string('pkidint', 100);
            $table->string('pkidstr', 100);
            $table->string('action', 50);
            $table->string('keterangan', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beone_log');
    }
}
