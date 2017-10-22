<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserInfoColumnsForUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('surname')->after('name');
            $table->timestamp('start_date')->nullable();
            $table->decimal('salary', 10, 2);
            $table->enum('user_role', array('','boss'));
            $table->integer('position_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('boss_id')->unsigned()->index();
        });

        Schema::table('users', function($table){
             $table->foreign('position_id')->references('id')->on('user_position');
             $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table) {
            $table->dropColumn('surname');
            $table->dropColumn('position_id');
            $table->dropColumn('category_id');
            $table->dropColumn('start_date');
            $table->dropColumn('salary');
            $table->dropColumn('boss_id');
            $table->dropColumn('user_role');
        });
    }
}
