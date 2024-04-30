<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRISKodePresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_kode_presensi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_presensi', 10);
            $table->string('keterangan', 50);
            $table->integer('hitung_hari_kerja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hris_kode_presensi');
    }
}
