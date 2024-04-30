<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRISSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_schedule', function (Blueprint $table) {
            $table->id();
            $table->string('tipe_schedule', 50);
            $table->string('nomor_user', 50);
            $table->date('tanggal');
            $table->time('clock_in');
            $table->time('clock_out');
            $table->timestamps();
            $table->unique(['nomor_user', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hris_schedule');
    }
}
