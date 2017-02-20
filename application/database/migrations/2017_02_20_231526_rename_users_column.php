<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameUsersColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table) {
            $table->renameColumn('actived', 'activated');
        });
    }


    public function down()
    {
        Schema::table('users', function($table) {
            $table->renameColumn('activated', 'actived');
        });
    }
}
