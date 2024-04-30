<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beone_users', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 50)->unique();
            $table->string('nama', 100);
            $table->string('username', 50)->unique();
            $table->string('password', 250);
            $table->string('email')->unique();
            $table->integer('group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beone_users');
    }
}
