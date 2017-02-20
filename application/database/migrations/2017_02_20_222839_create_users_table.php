<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_pegawai')->unsigned()->nullable();
            $table->string('name', 100)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('password', 225)->nullable();
            $table->integer('level')->nullable();
            $table->string('url_foto', 255)->nullable();
            $table->integer('actived');
            $table->timestamps();
        });

        Schema::table('users', function(Blueprint $table){
            $table->foreign('id_pegawai')->references('id')->on('pegawai');
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
