<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PagesAddSomeNewFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function(Blueprint $table)
        {
            $table->integer('number')->nullable();
            $table->integer('difficulty')->nullable();
            $table->string('course', 1024)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table)
        {
            $table->dropColumn('number');
            $table->dropColumn('difficulty');
            $table->dropColumn('course');
        });
    }
}
