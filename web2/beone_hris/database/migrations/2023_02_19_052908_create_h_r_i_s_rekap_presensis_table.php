<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRISRekapPresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_rekap_presensi', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_user', 50);
            $table->date('tanggal');
            $table->string('tipe_schedule', 20);
            $table->string('keterangan_status', 100); //ABSEN TIDAK LENGKAP, PULANG LEBIH CEPAT, TERLAMBAT
            $table->time('schedule_clock_in');
            $table->time('schedule_clock_out');
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->time('koreksi_clock_in')->nullable();
            $table->time('koreksi_clock_out')->nullable();
            $table->float('total_jam_kerja');
            $table->string('icon', 100);
            $table->string('class_badge', 100);
            $table->integer('hitung_hari_kerja'); //isi 1 apabila dihitung hari kerja, dan 0 apabila tidak
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
        Schema::dropIfExists('hris_rekap_presensi');
    }
}
