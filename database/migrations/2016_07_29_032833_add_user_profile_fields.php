<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserProfileFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table)
        {
            $table->string('url', 1024)->nullable();
            $table->string('avatar', 1024)->nullable();
            $table->enum('soctype', array('vk', 'ok', 'fb'))->default('vk');
            $table->boolean('newsletters')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropColumn('url');
            $table->dropColumn('avatar');
            $table->dropColumn('soctype');
            $table->dropColumn('newsletters');
        });
    }
}
