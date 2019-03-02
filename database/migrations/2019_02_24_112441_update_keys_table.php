<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('users', function($table) {
            $table->increments('id')->unsigned()->change();
        });*/
        Schema::table('keys', function($table)
        {
            $table->dropColumn('lastedit');
            $table->renameColumn('userid', 'user_id');
            $table->timestamps();
        }); // Commit here to apply the rename
        Schema::table('keys', function($table) {
            $table->integer('user_id')->unsigned()->change();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keys', function($table)
        {
            $table->integer('lastedit');
            $table->dropColumn(['created_at', 'updated_at']);
        });
    }
}
