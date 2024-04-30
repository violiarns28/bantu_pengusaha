
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRISPresensisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_presensi', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_user', 50);
            $table->date('nomor_user');
            $table->time('clock_in')->nullable();
            $table->time('clock_out')->nullable();
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('lokasi_presensi', 100)->nullable();
            $table->string('keterangan', 200)->nullable();
            $table->string('foto_clock_in', 200)->nullable();
            $table->string('foto_clock_out', 200)->nullable();
            $table->string('hardware_id', 50)->nullable();
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
        Schema::dropIfExists('hris_presensi');
    }
}
