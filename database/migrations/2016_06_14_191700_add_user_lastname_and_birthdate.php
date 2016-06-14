<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserLastnameAndBirthdate extends Migration
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
            $table->timestamp('birthdate')->nullable();
            $table->string('lastname')->nullable();
        });

        DB::table('users')->update(['birthdate' => date('Y-m-d')]);

        Schema::table('users', function(Blueprint $table)
        {
            $table->date('birthdate')->nullable(false)->change();
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
            $table->dropColumn('birthdate');
            $table->dropColumn('lastname');
        });
    }
}
