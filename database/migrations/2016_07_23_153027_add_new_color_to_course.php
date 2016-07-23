<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColorToCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function(Blueprint $table)
        {
            DB::statement("ALTER TABLE courses MODIFY COLUMN color ENUM('red', 'green', 'blue', 'purple', 'orange', 'yellow', 'olive')  NOT NULL DEFAULT 'red'");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function(Blueprint $table)
        {
            DB::statement("ALTER TABLE courses MODIFY COLUMN color ENUM('red', 'green', 'blue', 'purple', 'orange', 'yellow')  NOT NULL DEFAULT 'red'");
        });
    }
}
