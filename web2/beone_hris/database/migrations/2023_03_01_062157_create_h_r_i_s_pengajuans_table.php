<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRISPengajuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_user', 50);
            $table->date('tanggal');
            $table->date('tanggal2');
            $table->string('jenis_pengajuan', 50); //CUTI, TERLAMBAT, PULANG LEBIH CEPAT, IJIN, SAKIT
            $table->time('waktu')->nullable();
            $table->string('keterangan', 200)->nullable();
            $table->string('approve_by', 50)->nullable();
            $table->timestamp('approve_at')->nullable();
            $table->integer('status_approve')->nullable();
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
        Schema::dropIfExists('hris_pengajuan');
    }
}
