<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHRISGroupPresensiMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hris_group_presensi_member', function (Blueprint $table) {
            $table->id();
            $table->integer('group_presensi_id');
            $table->string('nomor_user', 50);
            $table->string('keterangan', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hris_group_presensi_member');
    }
}
