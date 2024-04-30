<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beone_menu', function (Blueprint $table) {
            $table->id();
            $table->string('nama',50)->unique();
            $table->string('route_menu',50);
            $table->integer('parent_id');
            $table->string('icon',250);
            $table->integer('isparent');
            $table->integer('issubparent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beone_menu');
    }
}
