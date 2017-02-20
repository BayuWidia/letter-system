<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratMasukanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_masukan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pegawai')->unsigned()->nullable();
            $table->integer('id_user')->unsigned()->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('nomor_surat', 255)->nullable();
            $table->string('perihal', 255)->nullable();
            $table->date('tanggal_terima')->nullable();
            $table->integer('disposisi_staff')->nullable();
            $table->integer('disposisi_bidang')->nullable();
            $table->integer('disposisi_sekdis')->nullable();
            $table->longtext('catatan')->nullable();
            $table->string('url_document', 255)->nullable();
            $table->integer('flag_approved')->nullable();
            $table->timestamps();
        });

        Schema::table('surat_masukan', function(Blueprint $table){
            $table->foreign('id_pegawai')->references('id')->on('pegawai');
        });

        Schema::table('surat_masukan', function(Blueprint $table){
            $table->foreign('id_user')->references('id')->on('users');
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
