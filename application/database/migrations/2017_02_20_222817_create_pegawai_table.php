<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_skpd')->unsigned()->nullable();
            $table->integer('id_jabatan')->unsigned()->nullable();
            $table->string('nama_pegawai', 100)->nullable();
            $table->string('nip', 50)->nullable();
            $table->string('url_foto', 255)->nullable();
            $table->integer('disposisi')->nullable();
            $table->integer('flag_pegawai')->default(0)->nullable();
            $table->timestamps();
        });

        Schema::table('pegawai', function(Blueprint $table){
            $table->foreign('id_skpd')->references('id')->on('skpd');
        });

        Schema::table('pegawai', function(Blueprint $table){
            $table->foreign('id_jabatan')->references('id')->on('jabatan');
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
