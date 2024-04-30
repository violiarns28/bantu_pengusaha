<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRISLembursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_lembur', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_user', 50);
            $table->date('tanggal');
            $table->string('jenis_pengajuan', 50); //DEFAULT VALUE LEMBUR
            $table->string('jenis_lembur', 50); //HARI KERJA, HARI LIBUR
            $table->time('waktu');
            $table->time('waktu2');
            $table->string('keterangan', 200);
            $table->string('approve_by', 50)->nullable();
            $table->timestamp('approve_at')->nullable();
            $table->integer('status_approve')->nullable();
            $table->float('total_jam_lembur');
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
        Schema::dropIfExists('hris_lembur');
    }
}
