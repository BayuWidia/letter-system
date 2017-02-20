<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSkpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skpd', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_skpd', 255)->nullable();
            $table->string('keterangan_skpd', 225)->nullable();
            $table->integer('flag_skpd')->default(0)->nullable();
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
        //
    }
}
